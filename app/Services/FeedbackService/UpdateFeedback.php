<?php

namespace App\Services\FeedbackService;

use App\Models\Feedback;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class UpdateFeedback extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Feedback::find($dto['id']);
        $query->content = $dto['content'];

        $this->prepareAuditUpdate($query);

        $query->save();

        $this->results['data'] = $query;

        //Isi pesan hasil proses
        $this->results['message'] = 'Feedback successfully updated';
    }
}
