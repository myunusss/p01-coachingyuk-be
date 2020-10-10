<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Activity\ActivityDestroyRequest;
use App\Http\Requests\Activity\ActivityGetRequest;
use App\Http\Requests\Activity\ActivityStoreRequest;
use App\Http\Requests\Activity\ActivityToggleHelpfulRequest;
use App\Http\Requests\Activity\ActivityUpdateRequest;

class ActivityController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/activities",
     *     tags={"Activity"},
     *     operationId="GetActivities",
     *     summary="Get list of Activity",
     *     description="",
     *     @OA\Parameter(ref="#/components/parameters/pagination-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-per-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-by"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-dir"),
     *     @OA\Parameter(
     *         name="topic_id",
     *         in="query",
     *         description="Topic Id of Activities to return",
     *         required=false,
     *         @OA\Schema(
     *             type="int"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User Id of Activities to return",
     *         required=false,
     *         @OA\Schema(
     *             type="int"
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
    public function index(ActivityGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'topic_id' => $request->topic_id ?? null,
            'user_id' => $request->user_id ?? null,
            'id' => $request->id ?? null
        ];
        $records = app('GetActivity')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/activities/{id}",
     *     tags={"Activity"},
     *     operationId="GetActivity",
     *     summary="Get Activity by id",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of Activities to return",
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
     *             @OA\Items(ref="#/components/schemas/Activity")
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
    public function show(ActivityGetRequest $request)
    {
        return $this->index($request);
    }

    /**
     * @OA\Post(
     *     path="/api/activities",
     *     tags={"Activity"},
     *     operationId="PostActivity",
     *     summary="Store Activity to system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Activity store request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityStoreRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/ActivityStoreRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Activity")
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
    public function store(ActivityStoreRequest $request)
    {
        $records = app('StoreActivity')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Put(
     *     path="/api/activities/{id}",
     *     tags={"Activity"},
     *     operationId="PutActivity",
     *     summary="Update Activity in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of Activities to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Activity update request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityUpdateRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/ActivityUpdateRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Activity")
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
    public function update(ActivityUpdateRequest $request)
    {
        $records = app('UpdateActivity')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Delete(
     *     path="/api/activities/{id}",
     *     tags={"Activity"},
     *     operationId="DeleteActivity",
     *     summary="Delete Activity in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of Activities to return",
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
     *             @OA\Items(ref="#/components/schemas/Activity")
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
    public function destroy(ActivityDestroyRequest $request)
    {
        $records = app('DestroyActivity')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
