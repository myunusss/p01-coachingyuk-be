<?php

namespace App\Services\ReplyService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\Reply;

class StoreReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $reply = new Reply();
        $reply->user_id = Auth::user()->id;
        $reply->answer_id = $dto['answer_id'];
        $reply->content = $dto['content'];

        $this->prepareAuditInsert($reply);

        $reply->save();

        $this->results['data'] = $reply;

        //Isi pesan hasil proses
        $this->results['message'] = 'Reply successfully created';
    }
}
