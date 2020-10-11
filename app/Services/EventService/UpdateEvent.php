<?php

namespace App\Services\EventService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Event;

class UpdateEvent extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $event = Event::find($dto['id']);
        $event->coach_id = isset($dto['coach_id']) ? $dto['coach_id'] : $event->coach_id;
        $event->name = isset($dto['name']) ? $dto['name'] : $event->name;
        $event->date = isset($dto['date']) ? $dto['date'] : $event->date;
        $event->location = isset($dto['location']) ? $dto['location'] : $event->location;
        $event->is_online = isset($dto['is_online']) ? $dto['is_online'] : $event->is_online;
        $event->is_free = isset($dto['is_free']) ? $dto['is_free'] : $event->is_free;
        $event->price = isset($dto['price']) ? $dto['price'] : $event->price;

        $this->prepareAuditUpdate($event);

        $event->save();

        $this->results['data'] = $event;

        //Isi pesan hasil proses
        $this->results['message'] = 'Event successfully updated';
    }
}
