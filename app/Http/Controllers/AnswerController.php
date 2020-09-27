<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Answer\AnswerDestroyRequest;
use App\Http\Requests\Answer\AnswerGetRequest;
use App\Http\Requests\Answer\AnswerStoreRequest;
use App\Http\Requests\Answer\AnswerToggleHelpfulRequest;
use App\Http\Requests\Answer\AnswerUpdateRequest;

class AnswerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/answers",
     *     tags={"Answer"},
     *     operationId="GetAnswers",
     *     summary="Get list of answer",
     *     description="",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function index(AnswerGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'question_id' => $request->question_id ?? null,
            'slug' => $request->slug ?? null
        ];
        $records = app('GetAnswer')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/answers/{slug}",
     *     tags={"Answer"},
     *     operationId="GetAnswer",
     *     summary="Get answer by slug",
     *     description="",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Slug of answers to return",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Answer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function show(AnswerGetRequest $request)
    {
        return $this->index($request);
    }

    /**
     * @OA\Post(
     *     path="/api/answers",
     *     tags={"Answer"},
     *     operationId="PostAnswer",
     *     summary="Store answer to system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Answer store request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AnswerStoreRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/AnswerStoreRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Answer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function store(AnswerStoreRequest $request)
    {
        $records = app('StoreAnswer')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Put(
     *     path="/api/answers/{slug}",
     *     tags={"Answer"},
     *     operationId="PutAnswer",
     *     summary="Update answer in system",
     *     description="",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Slug of answers to update",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Answer update request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AnswerUpdateRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/AnswerUpdateRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Answer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function update(AnswerUpdateRequest $request)
    {
        $records = app('UpdateAnswer')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Delete(
     *     path="/api/answers/{slug}",
     *     tags={"Answer"},
     *     operationId="DeleteAnswer",
     *     summary="Delete answer in system",
     *     description="",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Slug of answers to update",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Answer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function destroy(AnswerDestroyRequest $request)
    {
        $records = app('DestroyAnswer')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Post(
     *     path="/api/answers/toggle-helpful",
     *     tags={"Answer"},
     *     operationId="ToggleHelpfulAnswer",
     *     summary="Add/Remove user's helpful answer in system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Answer toggle helpful request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AnswerToggleHelpfulRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/AnswerToggleHelpfulRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Answer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function toggleHelpful(AnswerToggleHelpfulRequest $request)
    {
        $data = [
            'answer_id' => $request->answer_id ?? null,
            'id' => $request->id ?? null
        ];

        $records = app('ToggleHelpfulAnswer')->execute($data);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
