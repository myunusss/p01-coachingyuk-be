<?php

namespace App\Services\ActivityService;

use App\Models\Activity;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetActivity extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Activity::with([
            'user',
            'activityReplies' => function ($query) {
                return $query->with(['user']);
            }])->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['topic_id'] != null) {
            $query->where('topic_id', $dto['topic_id']);
        }

        if ($dto['user_id'] != null) {
            $query->where('user_id', $dto['user_id']);
        }

        if ($dto['id'] != null) {
            $query->where('id', $dto['id']);
            $data = $this->convert($query->first());
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $query->count());
            $query = $this->paginateData($query, $dto['per_page'], $dto['page']);
            $data = $query->get()->map(function ($query) {
                return $this->convert($query);
            });
        }

        $this->results['message'] = 'Activity data successfully fetched';
        $this->results['data'] = $data;
    }
    
    private function convert($query)
    {
        $response = $query;

        $response->total_streaks = 0;
        $response->total_likes = $query->likedUsers->count();
        $response->total_replies = $query->activityReplies->count();
        unset($newTopic->activityReplies);
        unset($newTopic->likedUsers);
        
        return $response;
    }
}
