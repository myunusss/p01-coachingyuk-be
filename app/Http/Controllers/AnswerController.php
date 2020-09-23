<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Answer\AnswerDestroyRequest;
use App\Http\Requests\Answer\AnswerGetRequest;
use App\Http\Requests\Answer\AnswerStoreRequest;
use App\Http\Requests\Answer\AnswerUpdateRequest;

class AnswerController extends Controller
{
    public function index(AnswerGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'question_id' => $request->search ?? '',
            'id' => $request->id ?? null
        ];
        $records = app('GetAnswer')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function store(AnswerStoreRequest $request)
    {
        $records = app('StoreAnswer')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function update(AnswerUpdateRequest $request)
    {
        $records = app('UpdateAnswer')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function destroy(AnswerDestroyRequest $request)
    {
        $records = app('DestroyAnswer')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
