<?php

namespace App\Services\UserService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\User;

class UpdateUser extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::find($dto['id']);
        $user->role_id = $dto['role_id'] ?? $user->role_id;
        $user->first_name = $dto['first_name'] ?? $user->first_name;
        $user->last_name = $dto['last_name'] ?? $user->last_name;
        $user->username = $dto['username'] ?? $user->username;
        $user->email = $dto['email'] ?? $user->email;
        $user->bio = $dto['bio'] ?? $user->bio;
        $user->password = $dto['password'] ? bcrypt($dto['password']) : $user->password;

        $this->prepareAuditUpdate($user);

        $user->save();

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully updated';
    }
}
