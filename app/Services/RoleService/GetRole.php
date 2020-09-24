<?php

namespace App\Services\RoleService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Role;

class GetRole extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = Role::orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['id'] != null) {
            $role->where('id', $dto['id']);
            $data = $role->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $role->count());
            $role = $this->paginateData($role, $dto['per_page'], $dto['page']);
            $data = $role->get();
        }

        $this->results['message'] = 'Role data successfully fetched';
        $this->results['data'] = $data;
    }
}
