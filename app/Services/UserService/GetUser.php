<?php

namespace App\Services\UserService;

use App\Models\User;
use App\Services\ServiceInterface;
use App\Services\DefaultService;
use Carbon\Carbon;

class GetUser extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $query = User::with(['followers', 'following'])->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['id'] != null) {
            $query->where('id', $dto['id']);
            $data = $this->convert($query->first());
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $query->count());
            $query = $this->paginateData($query, $dto['per_page'], $dto['page']);
            $data = $query->get()->map(function ($query) {
                return $this->convert($query);
            });
        }

        $this->results['message'] = 'User data successfully fetched';
        $this->results['data'] = $data;
    }
    
    private function convert($user)
    {
        $response = $user;

        $response->total_check_in_topics = $user->checkInTopics->count();
        $response->total_days = Carbon::now()
            ->startOfDay()
            ->diffInDays(carbon::parse($user->created_at)->startOfDay()) + 1;
        unset($user->checkInTopics);
        
        return $response;
    }
}
