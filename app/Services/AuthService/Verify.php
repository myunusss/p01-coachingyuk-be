<?php

namespace App\Services\AuthService;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use App\Models\Role;
use App\Models\User;

class Verify extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::where(DB::raw("MD5(id)"), $dto['token'])->first();
        
        if ($user == null) {
            $this->results['error'] = true;
            $this->results['message'] = 'User not found ' . $dto['token'];

            return;
        }

        $user->markEmailAsVerified();

        $this->prepareAuditUpdate($user);

        $user->save();

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully verified';
    }
}
