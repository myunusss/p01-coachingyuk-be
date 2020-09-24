<?php

namespace App\Services\RoleService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Role;

class UpdateRole extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = Role::find($dto['id']);
        $role->name = $dto['name'] ?? $role->name;
        $role->code = $dto['code'] ?? $role->code;

        $this->prepareAuditUpdate($role);

        $role->save();

        $this->results['data'] = $role;

        //Isi pesan hasil proses
        $this->results['message'] = 'Role successfully updated';
    }
}
