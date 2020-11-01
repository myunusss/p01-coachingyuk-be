<?php

namespace App\Services\AuthService;

use App\Models\User;
use App\Helpers\FileHelper;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use JWTAuth;

class ResetPassword extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::where('reset_password_token', $dto['token'])->first();

        if (empty($user)) {
            $this->results['error'] = NOT_FOUND_CODE;
            $this->results['message'] = 'User not found!';
            return;
        }

        $user->password = isset($dto['password']) ? bcrypt($dto['password']) : $user->password;
        $user->reset_password_token = null;

        $this->prepareAuditUpdate($user);

        $user->save();

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User password successfully reset';
    }
}
