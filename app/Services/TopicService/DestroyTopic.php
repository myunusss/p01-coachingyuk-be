<?php

namespace App\Services\TopicService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Topic;

class DestroyTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $topic = Topic::find($dto['id']);
        $topic->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Topic successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
