<?php

namespace App\Services\QuestionService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Question;

class DestroyQuestion extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $question = Question::find($dto['id']);
        $question->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Question successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
