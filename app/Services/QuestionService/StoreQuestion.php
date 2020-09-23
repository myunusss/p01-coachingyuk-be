<?php

namespace App\Services\QuestionService;

use App\Models\Question;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use Illuminate\Support\Facades\Auth;

class StoreQuestion extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $question = new Question();
        $question->topic_id = $dto['topic_id'];
        $question->user_id = $dto['user_id'];
        $question->content = $dto['content'];

        $this->prepareAuditInsert($question);

        $question->save();

        $this->results['data'] = $question;

        //Isi pesan hasil proses
        $this->results['message'] = 'Question successfully created';
    }
}
