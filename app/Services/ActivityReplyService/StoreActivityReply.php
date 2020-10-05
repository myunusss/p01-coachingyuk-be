<?php

namespace App\Services\ActivityReplyService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\ActivityReply;

class StoreActivityReply extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = new ActivityReply();
        $query->user_id = Auth::user()->id;
        $query->activity_id = $dto['activity_id'];
        $query->content = $dto['content'];

        $this->prepareAuditInsert($query);

        $query->save();

        $this->results['data'] = $query;

        //Isi pesan hasil proses
        $this->results['message'] = 'ActivityReply successfully created';
    }
}
