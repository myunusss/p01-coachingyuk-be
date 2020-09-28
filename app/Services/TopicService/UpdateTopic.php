<?php

namespace App\Services\TopicService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Topic;

class UpdateTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $topic = Topic::find($dto['id']);
        $topic->category_id = $dto['category_id'] ?? $topic->category_id;
        $topic->name = $dto['name'] ?? $topic->name;
        
        if ($dto['background'] != null) {
            $backgroundFile = $dto['background'];
            $category->background = FileHelper::uploadFile($backgroundFile);
        }

        $this->prepareAuditUpdate($topic);

        $topic->save();

        $this->results['data'] = $topic;

        //Isi pesan hasil proses
        $this->results['message'] = 'Topic successfully updated';
    }
}
