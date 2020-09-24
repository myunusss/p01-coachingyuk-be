<?php

namespace App\Services\AnswerService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\UserFollowedQuestion;

class FollowQuestion extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $action = 'followed';
        if ($dto['id'] == null) {
            $userFollowedQuestion = new UserFollowedQuestion();
            $userFollowedQuestion->user_id = Auth::user()->id;
            $userFollowedQuestion->question_id = $dto['question_id'];
    
            $this->prepareAuditInsert($userFollowedQuestion);
    
            $userFollowedQuestion->save();
        } else {
            $action = 'unfollowed';
            $userFollowedQuestion = UserFollowedQuestion::where('question_id', $dto['question_id'])
                ->where('user_id', Auth::user()->id)
                ->first();
            $userFollowedQuestion->delete();
        }

        $this->results['data'] = $userFollowedQuestion;

        //Isi pesan hasil proses
        $this->results['message'] = "Question successfully {$action}";
    }
}
