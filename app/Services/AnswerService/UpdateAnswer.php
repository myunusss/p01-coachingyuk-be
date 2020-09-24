<?php

namespace App\Services\AnswerService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Answer;

class UpdateAnswer extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $answer = Answer::find($dto['id']);
        $answer->content = $dto['content'];

        $this->prepareAuditUpdate($answer);

        $answer->save();

        $this->results['data'] = $answer;

        //Isi pesan hasil proses
        $this->results['message'] = 'Answer successfully updated';
    }
}
