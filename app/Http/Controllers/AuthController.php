<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Auth\AuthLoginRequest;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $records = app('Login')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = UNAUTHORIZED_CODE;
        return APIResponse::json($records, $code);
    }
}
