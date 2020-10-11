<?php

namespace App\Services\EventService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Event;

class DestroyEvent extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $event = Event::find($dto['id']);
        $event->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Event successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
