<?php

namespace App\Services\AuthService;

use Illuminate\Support\Facades\Mail;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use App\Mail\ForgotPasswordEmail;
use App\Models\User;
use Carbon\Carbon;
use JWTAuth;

class ForgotPassword extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::where('email', $dto['email'])->first();

        if ($user == null) {
            $this->results['error'] = NOT_FOUND_CODE;
            $this->results['message'] = 'User not found!';
            return;
        }

        $user->reset_password_token = $user->createToken('ResetPassword')->accessToken;
        $user->save();

        Mail::to($user->email)->send(
            new ForgotPasswordEmail(
                $user,
                $user->reset_password_token,
                $dto['callback_url']
            )
        );

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'forgot password email successfully sent';
    }
}
