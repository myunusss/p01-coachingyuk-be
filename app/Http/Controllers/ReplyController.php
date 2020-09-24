<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Reply\ReplyDestroyRequest;
use App\Http\Requests\Reply\ReplyGetRequest;
use App\Http\Requests\Reply\repliestoreRequest;
use App\Http\Requests\Reply\ReplyUpdateRequest;

class ReplyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/replies",
     *     tags={"Reply"},
     *     operationId="GetReplies",
     *     summary="Get list of reply",
     *     description="",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Reply")
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
    public function index(ReplyGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'answer_id' => $request->answer_id ?? '',
            'id' => $request->id ?? null
        ];
        $records = app('GetReply')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/replies/{id}",
     *     tags={"Reply"},
     *     operationId="GetReply",
     *     summary="Get reply by id",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of replies to return",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(ref="#/components/schemas/Reply")
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
    public function show(ReplyGetRequest $request)
    {
        return $this->index($request);
    }

    /**
     * @OA\Post(
     *     path="/api/replies",
     *     tags={"Reply"},
     *     operationId="PostReply",
     *     summary="Store reply to system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Reply store request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ReplyStoreRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/ReplyStoreRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Reply")
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
    public function store(repliestoreRequest $request)
    {
        $records = app('StoreReply')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Put(
     *     path="/api/replies/{id}",
     *     tags={"Reply"},
     *     operationId="PutReply",
     *     summary="Update reply in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of replies to update",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Reply update request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ReplyUpdateRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/ReplyUpdateRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Reply")
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
    public function update(ReplyUpdateRequest $request)
    {
        $records = app('UpdateReply')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }


    /**
     * @OA\Delete(
     *     path="/api/replies/{id}",
     *     tags={"Reply"},
     *     operationId="DeleteReply",
     *     summary="Delete reply in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of replies to update",
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
     *             @OA\Items(ref="#/components/schemas/Reply")
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
    public function destroy(ReplyDestroyRequest $request)
    {
        $records = app('DestroyReply')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
