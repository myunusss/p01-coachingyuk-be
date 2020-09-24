<?php

namespace App\Services\ReplyService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Reply;

class DestroyReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $reply = Reply::find($dto['id']);
        $reply->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Reply successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
