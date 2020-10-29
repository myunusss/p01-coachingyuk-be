<?php

namespace App\Services\FeedbackService;

use App\Models\Feedback;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetFeedback extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $feedbacks = Feedback::with(['user'])->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['user_id'] != null) {
            $feedbacks->where('user_id', $dto['user_id']);
        }
        
        if ($dto['type'] != null) {
            $feedbacks->where('type', $dto['type']);
        }

        if ($dto['id'] != null) {
            $feedbacks->where('id', $dto['id']);
            $data = $feedbacks->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $feedbacks->count());
            $feedbacks = $this->paginateData($feedbacks, $dto['per_page'], $dto['page']);
            $data = $feedbacks->get();
        }

        $this->results['message'] = 'Feedback data successfully fetched';
        $this->results['data'] = $data;
    }
}
