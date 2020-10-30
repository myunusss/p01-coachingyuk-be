<?php

namespace App\Services\AuthService;

use Illuminate\Support\Facades\Mail;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use App\Mail\VerifyEmail;
use App\Models\User;

class ResendVerificationEmail extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::where('email', $dto['email'])->first();

        if ($user == null) {
            $this->results['error'] = NOT_FOUND_CODE;
            $this->results['message'] = 'User not found!';
            return;
        }

        Mail::to($user->email)->send(new VerifyEmail($user, $dto['callback_url']));

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'New verification email successfully sent';
    }
}
