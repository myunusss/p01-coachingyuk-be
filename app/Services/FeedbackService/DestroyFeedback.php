<?php

namespace App\Services\FeedbackService;

use App\Models\Feedback;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class DestroyFeedback extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Feedback::find($dto['id']);
        $query->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Feedback successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
