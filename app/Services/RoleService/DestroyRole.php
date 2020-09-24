<?php

namespace App\Services\RoleService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Role;

class DestroyRole extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $role = Role::find($dto['id']);
        $role->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Role successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
