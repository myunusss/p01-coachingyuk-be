<?php

namespace App\Services\UserService;

use App\Models\User;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetUser extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['id'] != null) {
            $user->where('id', $dto['id']);
            $data = $user->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $user->count());
            $user = $this->paginateData($user, $dto['per_page'], $dto['page']);
            $data = $user->get();
        }

        $this->results['message'] = 'User data successfully fetched';
        $this->results['data'] = $data;
    }
}
