<?php

namespace App\Services\TopicService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
use App\Helpers\FileHelper;

class StoreTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $topic = new Topic();
        $topic->user_id = Auth::user()->id;
        $topic->category_id = $dto['category_id'];
        $topic->name = $dto['name'];
        
        $backgroundFile = $dto['background'];
        $category->background = FileHelper::uploadFile($backgroundFile);

        $this->prepareAuditInsert($topic);

        $topic->save();

        $this->results['data'] = $topic;

        //Isi pesan hasil proses
        $this->results['message'] = 'Topic successfully created';
    }
}
