<?php

namespace App\Services\AnswerService;

use App\Models\Answer;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetAnswer extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Answer::with('question', 'user', 'replies')->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['question_id'] != null) {
            $query->where('question_id', $dto['question_id']);
        }

        if ($dto['slug'] != null) {
            $query->where('slug', $dto['slug']);
            $data = $this->convert($query->first());
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $query->count());
            $query = $this->paginateData($query, $dto['per_page'], $dto['page']);
            $data = $query->get();
            $data = $query->get()->map(function ($query) {
                return $this->convert($query);
            });
        }

        $this->results['message'] = 'Answer data successfully fetched';
        $this->results['data'] = $data;
    }
    
    private function convert($answer)
    {
        $response = $answer;

        $response->total_helped_users = $answer->helpedUsers->count();
        $response->total_replies = $answer->replies->count();
        unset($newTopic->helpedUsers);
        
        return $response;
    }
}
