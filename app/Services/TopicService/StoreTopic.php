<?php

namespace App\Services\TopicService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\Topic;

class StoreTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $topic = new Topic();
        $topic->user_id = Auth::user()->id;
        $topic->name = $dto['name'];
        $topic->background = $dto['background'];

        $this->prepareAuditInsert($topic);

        $topic->save();

        $this->results['data'] = $topic;

        //Isi pesan hasil proses
        $this->results['message'] = 'Topic successfully created';
    }
}
