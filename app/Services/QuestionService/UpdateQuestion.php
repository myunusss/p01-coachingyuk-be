<?php

namespace App\Services\QuestionService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Question;

class UpdateQuestion extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $question = Question::find($dto['id']);
        $question->content = $dto['content'];

        $this->prepareAuditUpdate($question);

        $question->save();

        $this->results['data'] = $question;

        //Isi pesan hasil proses
        $this->results['message'] = 'Question successfully updated';
    }
}
