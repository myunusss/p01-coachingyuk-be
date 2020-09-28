<?php

namespace App\Services\AnswerService;

use App\Models\Answer;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetAnswer extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $answer = Answer::with('question', 'user', 'replies')->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['question_id'] != null) {
            $answer->where('question_id', $dto['question_id']);
        }

        if ($dto['slug'] != null) {
            $answer->where('slug', $dto['slug']);
            $data = $answer->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $answer->count());
            $answer = $this->paginateData($answer, $dto['per_page'], $dto['page']);
            $data = $answer->get();
        }

        $this->results['message'] = 'Answer data successfully fetched';
        $this->results['data'] = $data;
    }
}
