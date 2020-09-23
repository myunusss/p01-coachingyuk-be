<?php

namespace App\Services\UserService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StoreUser extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = new User();
        $user->first_name = $dto['first_name'];
        $user->last_name = $dto['last_name'];
        $user->username = $dto['username'];
        $user->email = $dto['email'];
        $user->password = bcrypt($dto['password']);
        $user->bio = $dto['bio'];

        $this->prepareAuditInsert($user);

        $user->save();

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully created';
    }
}
