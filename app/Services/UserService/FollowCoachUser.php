<?php

namespace App\Services\ActivityService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\UserFollowCoach;

class FollowCoachUser extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $action = 'followed';
        $userFollowCoach = UserFollowCoach::where('coach_id', $dto['coach_id'])
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($userFollowCoach == null) {
            $userFollowCoach = new UserFollowCoach();
            $userFollowCoach->user_id = Auth::user()->id;
            $userFollowCoach->coach_id = $dto['coach_id'];
    
            $this->prepareAuditInsert($userFollowCoach);
    
            $userFollowCoach->save();
        } else {
            $action = 'unfollowed';
            $userFollowCoach->delete();
        }

        $this->results['data'] = $userFollowCoach;

        //Isi pesan hasil proses
        $this->results['message'] = "Coach successfully {$action}";
    }
}
