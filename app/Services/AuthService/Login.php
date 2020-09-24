<?php

namespace App\Services\AuthService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::with('role')->where('username', $dto['username'])->first();

        if (empty($user)) {
            $this->results['error'] = NOT_FOUND_CODE;
            $this->results['message'] = 'User not found!';
            return;
        }

        if (!Auth::attempt(['username' => $user['username'], 'password' => $dto['password']])) {
            $this->results['error'] = UNAUTHORIZED_CODE;
            $this->results['message'] = 'Wrong Password!';
            return;
        }

        $this->results['message'] = 'You are logged in';
        $this->results['data'] = $user;
        $this->results['data']['token'] = $user->createToken('MyApp')->accessToken;
    }
}
