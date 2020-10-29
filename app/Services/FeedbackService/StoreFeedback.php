<?php

namespace App\Services\FeedbackService;

use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class StoreFeedback extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $feedback = new Feedback();
        $feedback->user_id = Auth::user()->id;
        $feedback->type = $dto['type'];
        $feedback->content = $dto['content'];
        $feedback->email = $dto['email'];
        
        $this->prepareAuditInsert($feedback);

        $feedback->save();

        $this->results['data'] = $feedback;

        //Isi pesan hasil proses
        $this->results['message'] = null;

        //Optional
        $this->results['pagination'] = null;
    }
}
