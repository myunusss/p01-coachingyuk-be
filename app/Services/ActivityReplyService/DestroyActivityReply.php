<?php

namespace App\Services\ActivityReplyService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\ActivityReply;

class DestroyActivityReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = ActivityReply::find($dto['id']);
        $query->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'ActivityReply successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
