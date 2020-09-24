<?php

namespace App\Services\AnswerService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Answer;

class DestroyAnswer extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $answer = Answer::find($dto['id']);
        $answer->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Answer successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
