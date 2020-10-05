<?php

namespace App\Services\ActivityReplyService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\ActivityReply;

class UpdateActivityReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = ActivityReply::find($dto['id']);
        $query->content = $dto['content'];

        $this->prepareAuditUpdate($query);

        $query->save();

        $this->results['data'] = $query;

        //Isi pesan hasil proses
        $this->results['message'] = 'ActivityReply successfully updated';
    }
}
