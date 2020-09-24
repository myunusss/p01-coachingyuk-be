<?php

namespace App\Services\AnswerService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\UserJoinedTopic;

class JoinTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $action = 'joined';
        if ($dto['id'] == null) {
            $userJoinedTopic = new UserJoinedTopic();
            $userJoinedTopic->user_id = Auth::user()->id;
            $userJoinedTopic->topic_id = $dto['topic_id'];
    
            $this->prepareAuditInsert($userJoinedTopic);
    
            $userJoinedTopic->save();
        } else {
            $action = 'left';
            $userJoinedTopic = UserJoinedTopic::where('topic_id', $dto['topic_id'])
                ->where('user_id', Auth::user()->id)
                ->first();
            $userJoinedTopic->delete();
        }

        $this->results['data'] = $userJoinedTopic;

        //Isi pesan hasil proses
        $this->results['message'] = "Topic successfully {$action}";
    }
}
