<?php

namespace App\Services\UserService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\User;
use App\Helpers\FileHelper;

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
        $user->password = isset($dto['password']) ? bcrypt($dto['password']) : $user->password;
        
        if (isset($dto['avatar'])) {
            $avatarFile = $dto['avatar'];
            $user->avatar = FileHelper::uploadFile($avatarFile, 'avatars');
        }

        if (isset($dto['header_image'])) {
            $headerImageFile = $dto['header_image'];
            $user->header_image = FileHelper::uploadFile($headerImageFile, 'header-images');
        }

        $this->prepareAuditUpdate($user);

        $user->save();

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully updated';
    }
}
