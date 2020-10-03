<?php

namespace App\Services\TopicService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\UserJoinedTopic;

class JoinTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $action = 'joined';
        $userJoinedTopic = UserJoinedTopic::where('user_id', Auth::user()->id)
            ->where('topic_id', $dto['topic_id'])
            ->first();

        if ($userJoinedTopic == null) {
            $userJoinedTopic = new UserJoinedTopic();
            $userJoinedTopic->user_id = Auth::user()->id;
            $userJoinedTopic->topic_id = $dto['topic_id'];
    
            $this->prepareAuditInsert($userJoinedTopic);
    
            $userJoinedTopic->save();
        } else {
            $action = 'left';
            $userJoinedTopic->delete();
        }

        $this->results['data'] = $userJoinedTopic;

        //Isi pesan hasil proses
        $this->results['message'] = "Topic successfully {$action}";
    }
}
