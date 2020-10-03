<?php

namespace App\Services\UserService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\FileHelper;

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
        
        if (FileHelper::isFileExist($dto['avatar'])) {
            $avatarFile = $dto['avatar'];
            $user->avatar = FileHelper::uploadFile($avatarFile, 'avatars');
        }

        if (FileHelper::isFileExist($dto['header_image'])) {
            $headerImageFile = $dto['header_image'];
            $user->header_image = FileHelper::uploadFile($headerImageFile, 'header-images');
        }

        $this->prepareAuditInsert($user);

        $user->save();

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully created';
    }
}
