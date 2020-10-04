<?php

namespace App\Services\ReplyService;

use App\Models\Reply;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Reply::with(['user', 'answer'])->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['answer_id'] != null) {
            $query->where('answer_id', $dto['answer_id']);
        }

        if ($dto['id'] != null) {
            $query->where('id', $dto['id']);
            $data = $query->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $query->count());
            $query = $this->paginateData($query, $dto['per_page'], $dto['page']);
            $data = $query->get();
        }

        $this->results['message'] = 'Reply data successfully fetched';
        $this->results['data'] = $data;
    }
}
