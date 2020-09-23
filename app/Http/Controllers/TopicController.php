<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Topic\TopicDestroyRequest;
use App\Http\Requests\Topic\TopicGetRequest;
use App\Http\Requests\Topic\TopicStoreRequest;
use App\Http\Requests\Topic\TopicUpdateRequest;

class TopicController extends Controller
{
    public function index(TopicGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'question_id' => $request->search ?? '',
            'slug' => $request->slug ?? null
        ];
        $records = app('GetTopic')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function show(AnswerGetRequest $request)
    {
        return $this->index($request);
    }

    public function store(TopicStoreRequest $request)
    {
        $records = app('StoreTopic')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function update(TopicUpdateRequest $request)
    {
        $records = app('UpdateTopic')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    public function destroy(TopicDestroyRequest $request)
    {
        $records = app('DestroyTopic')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
