<?php

namespace App\Service\AuthService;

use App\Service\ServiceInterface;
use App\Service\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Login extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $user = User::where('username', $dto['username'])->orWhere('email', $dto['email'])->first();
        $this->results['code'] = UNAUTHORIZED_CODE;
        $this->results['status'] = UNAUTHORIZED_STATUS;
        if (empty($user)) {
            $json['message'] = "User not found!";
            return APIResponse::json($json, $json['code']);
        }
        $zones = Zone::all();
        $selectedZone = null;
        $min_distance = PHP_INT_MAX;
        $address = new Address();
        $address->name = $dto['name'];
        $address->detail_address = $dto['detail_address'];

        $this->prepareAuditInsert($address);

        $address->save();

        $this->results['data'] = $address;

        //Isi pesan hasil proses
        $this->results['message'] = 'Alamat berhasil ditambahkan';
    }
}
