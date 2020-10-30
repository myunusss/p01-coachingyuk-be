<?php

namespace App\Services\AuthService;

use Illuminate\Support\Facades\Mail;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use App\Mail\VerifyEmail;
use App\Models\Role;
use App\Models\User;

class Register extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = Role::where('code', 'user')->first();
        $users = User::where('username', $dto['username'])->orWhere('email', $dto['email'])->get();

        if (!$users->isEmpty()) {
            $this->results['error'] = true;
            $this->results['code'] = UNPROCESSABLE_ENTITY_CODE;
            $this->results['message'] = 'This username/email has already been used';
            return;
        }

        $user = new User();
        $user->role_id = $role->id;
        $user->first_name = $dto['first_name'];
        $user->last_name = $dto['last_name'];
        $user->username = $dto['username'];
        $user->email = $dto['email'];
        $user->password = bcrypt($dto['password']);
        $user->timezone = $dto['timezone'];

        $this->prepareAuditInsert($user);

        $user->save();

        Mail::to($user->email)->send(new VerifyEmail($user, $dto['callback_url']));

        $this->results['data'] = $user;
        $this->results['data']['token'] = $user->createToken('MyApp')->accessToken;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully registered';
    }
}
