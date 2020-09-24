<?php

namespace App\Services\ReplyService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Reply;

class UpdateReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $reply = Reply::find($dto['id']);
        $reply->content = $dto['content'];

        $this->prepareAuditUpdate($reply);

        $reply->save();

        $this->results['data'] = $reply;

        //Isi pesan hasil proses
        $this->results['message'] = 'Reply successfully updated';
    }
}
