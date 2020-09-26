<?php

namespace App\Services\AuthService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Role;
use App\Models\User;

class Register extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = Role::where('code', 'user')->first();
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

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully registered';
    }
}
