<?php

namespace App\Services\TopicService;

use App\Models\Topic;
use App\Models\UserJoinedTopic;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $topic = Topic::with(['category', 'questions'])->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['user_id'] != null) {
            $topicIds = UserJoinedTopic::where('user_id', $dto['user_id'])->pluck('topic_id');
            $topic->whereIn('id', $topicIds);
        }
        
        if ($dto['category_id'] != null) {
            $topic->where('category_id', $dto['category_id']);
        }

        if ($dto['slug'] != null) {
            $topic->where('slug', $dto['slug']);
            $data = $topic->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $topic->count());
            $topic = $this->paginateData($topic, $dto['per_page'], $dto['page']);
            $data = $topic->get();
        }

        $this->results['message'] = 'Topic data successfully fetched';
        $this->results['data'] = $data;
    }
}
