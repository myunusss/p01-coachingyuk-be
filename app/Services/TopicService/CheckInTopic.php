<?php

namespace App\Services\TopicService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\UserCheckInTopic;

class CheckInTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $action = 'joined';
        if ($dto['id'] == null) {
            $userCheckInTopic = new UserCheckInTopic();
            $userCheckInTopic->user_id = Auth::user()->id;
            $userCheckInTopic->topic_id = $dto['topic_id'];
            $userCheckInTopic->date = Carbon::now()->format('Y-m-d');
    
            $this->prepareAuditInsert($userCheckInTopic);
    
            $userCheckInTopic->save();
        } else {
            $action = 'left';
            $userCheckInTopic = UserCheckInTopic::where('topic_id', $dto['topic_id'])
                ->where('user_id', Auth::user()->id)
                ->where('date', Carbon::now()->format('Y-m-d'))
                ->first();
            $userCheckInTopic->delete();
        }

        $this->results['data'] = $userCheckInTopic;

        //Isi pesan hasil proses
        $this->results['message'] = "Topic successfully {$action}";
    }
}
