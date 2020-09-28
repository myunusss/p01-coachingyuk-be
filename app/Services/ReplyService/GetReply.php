<?php

namespace App\Services\ReplyService;

use App\Models\Reply;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $replies = Reply::with(['answer'])->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['id'] != null) {
            $replies->where('id', $dto['id']);
            $data = $replies->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $replies->count());
            $replies = $this->paginateData($replies, $dto['per_page'], $dto['page']);
            $data = $replies->get();
        }

        $this->results['message'] = 'Reply data successfully fetched';
        $this->results['data'] = $data;
    }
}
