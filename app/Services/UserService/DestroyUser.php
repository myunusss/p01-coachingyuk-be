<?php

namespace App\Services\UserService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\User;

class DestroyUser extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::find($dto['id']);
        $user->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'User successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
