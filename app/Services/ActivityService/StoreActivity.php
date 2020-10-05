<?php

namespace App\Services\ActivityService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\Activity;

class StoreActivity extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = new Activity();
        $query->user_id = Auth::user()->id;
        $query->topic_id = $dto['topic_id'];
        $query->content = $dto['content'];

        $this->prepareAuditInsert($query);

        $query->save();

        $this->results['data'] = $query;

        //Isi pesan hasil proses
        $this->results['message'] = 'Activity successfully created';
    }
}
