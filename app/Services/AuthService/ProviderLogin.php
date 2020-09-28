<?php

namespace App\Services\AuthService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProviderLogin extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = Role::where('code', 'user')->first();
        $user = User::where('provider_id', $user->id)->first();
        if (!$user) {
            $user = new User();
            $user->role_id = $role->id;
            $user->first_name = $dto['user']->user['first_name'];
            $user->last_name = $dto['user']->user['last_name'];
            $user->email = !empty($dto['user']->email) ? $dto['user']->email : null;
            $user->provider = $dto['provider'];
            $user->provider_id = $dto['provider_id'];
    
            $this->prepareAuditInsert($user);
    
            $user->save();
        }

        $this->results['message'] = 'You are logged in';
        $this->results['data'] = $user;
        $this->results['data']['token'] = $user->createToken('MyApp')->accessToken;
    }
}
