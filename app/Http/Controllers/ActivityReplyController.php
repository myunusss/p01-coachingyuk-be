<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\ActivityReply\ActivityReplyDestroyRequest;
use App\Http\Requests\ActivityReply\ActivityReplyGetRequest;
use App\Http\Requests\ActivityReply\ActivityReplyStoreRequest;
use App\Http\Requests\ActivityReply\ActivityReplyToggleHelpfulRequest;
use App\Http\Requests\ActivityReply\ActivityReplyUpdateRequest;

class ActivityReplyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/activity-replies",
     *     tags={"ActivityReply"},
     *     operationId="GetActivity Replies",
     *     summary="Get list of ActivityReply",
     *     description="",
     *     @OA\Parameter(ref="#/components/parameters/pagination-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-per-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-by"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-dir"),
     *     @OA\Parameter(
     *         name="activity_id",
     *         in="query",
     *         description="Activity Id of Activity Replies to return",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
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
    public function index(ActivityReplyGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'activity_id' => $request->activity_id ?? null,
            'user_id' => $request->user_id ?? null,
            'id' => $request->id ?? null
        ];
        $records = app('GetActivityReply')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/activity-replies/{id}",
     *     tags={"ActivityReply"},
     *     operationId="GetActivityReply",
     *     summary="Get ActivityReply by id",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of Activity Replies to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ActivityReply")
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
    public function show(ActivityReplyGetRequest $request)
    {
        return $this->index($request);
    }

    /**
     * @OA\Post(
     *     path="/api/activity-replies",
     *     tags={"ActivityReply"},
     *     operationId="PostActivityReply",
     *     summary="Store ActivityReply to system",
     *     description="",
     *     @OA\RequestBody(
     *         description="ActivityReply store request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityReplyStoreRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/ActivityReplyStoreRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ActivityReply")
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
    public function store(ActivityReplyStoreRequest $request)
    {
        $records = app('StoreActivityReply')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Put(
     *     path="/api/activity-replies/{id}",
     *     tags={"ActivityReply"},
     *     operationId="PutActivityReply",
     *     summary="Update ActivityReply in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of Activity Replies to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="ActivityReply update request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityReplyUpdateRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/ActivityReplyUpdateRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ActivityReply")
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
    public function update(ActivityReplyUpdateRequest $request)
    {
        $records = app('UpdateActivityReply')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Delete(
     *     path="/api/activity-replies/{id}",
     *     tags={"ActivityReply"},
     *     operationId="DeleteActivityReply",
     *     summary="Delete ActivityReply in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of Activity Replies to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ActivityReply")
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
    public function destroy(ActivityReplyDestroyRequest $request)
    {
        $records = app('DestroyActivityReply')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
