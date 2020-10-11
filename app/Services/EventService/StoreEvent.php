<?php

namespace App\Services\EventService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Helpers\FileHelper;

class StoreEvent extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $event = new Event();
        $event->coach_id = $dto['coach_id'];
        $event->name = $dto['name'];
        $event->date = $dto['date'];
        $event->location = $dto['location'];
        $event->is_online = $dto['is_online'];
        $event->is_free = $dto['is_free'];
        $event->price = $dto['price'];

        $this->prepareAuditInsert($event);

        $event->save();

        $this->results['data'] = $event;

        //Isi pesan hasil proses
        $this->results['message'] = 'Event successfully created';
    }
}
