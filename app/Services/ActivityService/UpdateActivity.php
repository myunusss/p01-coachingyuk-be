<?php

namespace App\Services\ActivityService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Activity;

class UpdateActivity extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Activity::find($dto['id']);
        $query->content = $dto['content'];
        $query->note = $dto['note'];

        $this->prepareAuditUpdate($query);

        $query->save();

        $this->results['data'] = $query;

        //Isi pesan hasil proses
        $this->results['message'] = 'Activity successfully updated';
    }
}
