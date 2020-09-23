<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\User\UserDestroyRequest;
use App\Http\Requests\User\UserGetRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    public function index(UserGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'question_id' => $request->search ?? '',
            'id' => $request->id ?? null
        ];
        $records = app('GetUser')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function show(UserGetRequest $request)
    {
        return $this->index($request);
    }

    public function store(UserStoreRequest $request)
    {
        $records = app('StoreUser')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function update(UserUpdateRequest $request)
    {
        $records = app('UpdateUser')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function destroy(UserDestroyRequest $request)
    {
        $records = app('DestroyUser')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
