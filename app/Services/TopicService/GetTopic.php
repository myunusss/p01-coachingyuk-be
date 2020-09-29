<?php

namespace App\Services\TopicService;

use App\Models\Topic;
use App\Models\UserJoinedTopic;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use Carbon\Carbon;

class GetTopic extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $topics = Topic::with([
            'category',
            'checkInUsers' => function ($query) use ($dto) {
                if ($dto['user_id'] != null) {
                    $query->where('user_id', $dto['user_id']);
                }
            },
            'user',
            'questions'])->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['user_id'] != null) {
            $topicIds = UserJoinedTopic::where('user_id', $dto['user_id'])->pluck('topic_id');
            $topics->whereIn('id', $topicIds);
        }
        
        if ($dto['category_id'] != null) {
            $topics->where('category_id', $dto['category_id']);
        }

        if ($dto['slug'] != null) {
            $topics->where('slug', $dto['slug']);
            $data = $this->convert($topics->first());
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $topics->count());
            $topics = $this->paginateData($topics, $dto['per_page'], $dto['page']);
            $data = $topics->get()->map(function ($topic) {
                return $this->convert($topic);
            });
        }

        $this->results['message'] = 'Topic data successfully fetched';
        $this->results['data'] = $data;
    }

    private function convert($topic)
    {
        $response = $topic;
        $response->total_users = $topic->joinedUsers->count();
        $response->total_check_ins = $topic->checkInUsers->count();
        $response->total_coach_users = $topic->joinedUsers
            ->filter(function ($user) {
                return $user->role->code == 'coach';
            })->count();
        return $response;
    }
}
