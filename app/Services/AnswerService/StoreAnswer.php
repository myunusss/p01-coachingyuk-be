<?php

namespace App\Services\AnswerService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\Answer;

class StoreAnswer extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $answer = new Answer();
        $answer->user_id = $dto['user_id'];
        $answer->question_id = $dto['question_id'];
        $answer->content = $dto['content'];

        $this->prepareAuditInsert($answer);

        $answer->save();

        $this->results['data'] = $answer;

        //Isi pesan hasil proses
        $this->results['message'] = 'Answer successfully created';
    }
}
