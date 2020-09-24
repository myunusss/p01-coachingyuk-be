<?php

namespace App\Services\AnswerService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\UserHelpfulAnswer;

class ToggleHelpfulAnswer extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $action = 'liked';
        if ($dto['id'] == null) {
            $userHelpfulAnswer = new UserHelpfulAnswer();
            $userHelpfulAnswer->user_id = Auth::user()->id;
            $userHelpfulAnswer->answer_id = $dto['answer_id'];
    
            $this->prepareAuditInsert($userHelpfulAnswer);
    
            $userHelpfulAnswer->save();
        } else {
            $action = 'unliked';
            $userHelpfulAnswer = UserHelpfulAnswer::where('answer_id', $dto['answer_id'])
                ->where('user_id', Auth::user()->id)
                ->first();
            $userHelpfulAnswer->delete();
        }

        $this->results['data'] = $userHelpfulAnswer;

        //Isi pesan hasil proses
        $this->results['message'] = "Answer successfully {$action}";
    }
}
