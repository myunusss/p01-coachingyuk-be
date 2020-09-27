<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Topic\TopicDestroyRequest;
use App\Http\Requests\Topic\TopicGetRequest;
use App\Http\Requests\Topic\TopicStoreRequest;
use App\Http\Requests\Topic\TopicUpdateRequest;

class TopicController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/topics",
     *     tags={"Topic"},
     *     operationId="GetTopics",
     *     summary="Get list of topics",
     *     description="",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Topic")
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
    public function index(TopicGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'user_id' => $request->user_id ?? null,
            'category_id' => $request->category_id ?? null,
            'slug' => $request->slug ?? null
        ];
        $records = app('GetTopic')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/topics/{slug}",
     *     tags={"Topic"},
     *     operationId="GetTopic",
     *     summary="Get topic by slug",
     *     description="",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Slug of topic to return",
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
     *             @OA\Items(ref="#/components/schemas/Topic")
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
     *     path="/api/topics",
     *     tags={"Topic"},
     *     operationId="PostTopic",
     *     summary="Store topic to system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Topic store request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TopicStoreRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/TopicStoreRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Topic")
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
    public function store(TopicStoreRequest $request)
    {
        $records = app('StoreTopic')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Put(
     *     path="/api/topics/{slug}",
     *     tags={"Topic"},
     *     operationId="PutTopic",
     *     summary="Update topic in system",
     *     description="",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Slug of topic to update",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Topic update request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TopicUpdateRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/TopicUpdateRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Topic")
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
    public function update(TopicUpdateRequest $request)
    {
        $records = app('UpdateTopic')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Delete(
     *     path="/api/topics/{slug}",
     *     tags={"Topic"},
     *     operationId="DeleteTopic",
     *     summary="Delete topic in system",
     *     description="",
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="Slug of topic to update",
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
     *             @OA\Items(ref="#/components/schemas/Topic")
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
    public function destroy(TopicDestroyRequest $request)
    {
        $records = app('DestroyTopic')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Post(
     *     path="/api/topics/join",
     *     tags={"Topic"},
     *     operationId="JoinTopic",
     *     summary="Add/Remove user's joined topic in system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Topic join request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TopicJoinRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/TopicJoinRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Topic")
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
    public function join(TopicJoinRequest $request)
    {
        $records = app('JoinTopic')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
