<?php

namespace App\Services\EventService;

use App\Models\Event;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetEvent extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = Event::with('coach')->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['coach_id'] != null) {
            $query->where('coach_id', $dto['coach_id']);
        }

        if ($dto['id'] != null) {
            $query->where('id', $dto['id']);
            $data = $this->convert($query->first());
        } else {
            $this->results['pagination'] = $this->paginationDetail(
                $dto['per_page'],
                $dto['page'],
                $query->count()
            );
            $query = $this->paginateData($query, $dto['per_page'], $dto['page']);
            $data = $query->get()->map(function ($event) {
                return $this->convert($event);
            });
        }

        $this->results['message'] = 'Event data successfully fetched';
        $this->results['data'] = $data;
    }
    
    private function convert($event)
    {
        $response = $event;
        
        return $response;
    }
}
