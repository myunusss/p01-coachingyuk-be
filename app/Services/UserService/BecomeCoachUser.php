<?php

namespace App\Services\UserService;

use App\Models\Role;
use App\Models\User;
use App\Helpers\FileHelper;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;

class BecomeCoachUser extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = Role::where('code', 'coach')->first();
        $user = User::find(Auth::user()->id);
        $user->role_id = $role->id;

        $this->prepareAuditUpdate($user);

        $user->save();

        $this->results['data'] = $user;

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully become coach';
    }
}
