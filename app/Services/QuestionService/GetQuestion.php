<?php

namespace App\Services\QuestionService;

use App\Models\Question;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class Get extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $question = Question::orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['id'] != null) {
            $question->where('id', $dto['id']);
            $data = $question->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $question->count());
            $question = $this->paginateData($question, $dto['per_page'], $dto['page']);
            $data = $question->get();
        }

        $this->results['message'] = 'Question data successfully fetched';
        $this->results['data'] = $data;
    }
}
