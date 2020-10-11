<?php

namespace App\Services\ActivityService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\UserLikedActivity;

class ToggleLikedActivity extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $action = 'liked';
        $userLikedActivity = UserLikedActivity::where('activity_id', $dto['activity_id'])
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($userLikedActivity == null) {
            $userLikedActivity = new UserLikedActivity();
            $userLikedActivity->user_id = Auth::user()->id;
            $userLikedActivity->activity_id = $dto['activity_id'];
    
            $this->prepareAuditInsert($userLikedActivity);
    
            $userLikedActivity->save();
        } else {
            $action = 'unliked';
            $userLikedActivity->delete();
        }

        $this->results['data'] = $userLikedActivity;

        //Isi pesan hasil proses
        $this->results['message'] = "Activity successfully {$action}";
    }
}
