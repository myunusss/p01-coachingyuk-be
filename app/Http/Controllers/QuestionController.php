<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Question\QuestionDestroyRequest;
use App\Http\Requests\Question\QuestionGetRequest;
use App\Http\Requests\Question\QuestionStoreRequest;
use App\Http\Requests\Question\QuestionUpdateRequest;

class QuestionController extends Controller
{
    public function index(QuestionGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'question_id' => $request->search ?? '',
            'slug' => $request->slug ?? null
        ];
        $records = app('GetQuestion')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function show(AnswerGetRequest $request)
    {
        return $this->index($request);
    }

    public function store(QuestionStoreRequest $request)
    {
        $records = app('StoreQuestion')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function update(QuestionUpdateRequest $request)
    {
        $records = app('UpdateQuestion')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function destroy(QuestionDestroyRequest $request)
    {
        $records = app('DestroyQuestion')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
