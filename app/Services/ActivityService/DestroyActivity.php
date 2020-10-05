<?php

namespace App\Services\ActivityService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Activity;

class DestroyActivity extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Activity::find($dto['id']);
        $query->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Activity successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
