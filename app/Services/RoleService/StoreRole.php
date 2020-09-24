<?php

namespace App\Services\RoleService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Role;

class StoreRole extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = new Role();
        $role->name = $dto['name'];
        $role->code = $dto['code'];

        $this->prepareAuditInsert($role);

        $role->save();

        $this->results['data'] = $role;

        //Isi pesan hasil proses
        $this->results['message'] = 'Role successfully created';
    }
}
