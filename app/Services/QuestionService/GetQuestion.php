<?php

namespace App\Services\QuestionService;

use App\Models\Question;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetQuestion extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Question::with('topic', 'user', 'answers')->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['topic_id'] != null) {
            $query->where('topic_id', $dto['topic_id']);
        }

        if ($dto['slug'] != null) {
            $query->where('slug', $dto['slug']);
            $data = $this->convert($query->first());
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $query->count());
            $query = $this->paginateData($query, $dto['per_page'], $dto['page']);
            $data = $query->get()->map(function ($query) {
                return $this->convert($query);
            });
        }

        $this->results['message'] = 'Question data successfully fetched';
        $this->results['data'] = $data;
    }
    
    private function convert($question)
    {
        $response = $question;

        $response->total_answers = $question->answers->count();
        
        return $response;
    }
}
