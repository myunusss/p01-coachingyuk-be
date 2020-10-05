<?php

namespace App\Services\ActivityReplyService;

use App\Models\ActivityReply;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetActivityReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = ActivityReply::orderBy($dto['sort_by'], $dto['sort_dir']);

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

        $this->results['message'] = 'ActivityReply data successfully fetched';
        $this->results['data'] = $data;
    }
    
    private function convert($query)
    {
        $response = $query;

        $response->total_streaks = 0;
        $response->total_replies = $query->activityReplies->count();
        unset($newTopic->activityReplies);
        
        return $response;
    }
}
