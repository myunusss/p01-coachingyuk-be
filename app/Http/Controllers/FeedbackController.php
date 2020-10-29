<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Feedback\FeedbackDestroyRequest;
use App\Http\Requests\Feedback\FeedbackFollowRequest;
use App\Http\Requests\Feedback\FeedbackGetRequest;
use App\Http\Requests\Feedback\FeedbackStoreRequest;
use App\Http\Requests\Feedback\FeedbackUpdateRequest;

class FeedbackController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/feedbacks",
     *     tags={"Feedback"},
     *     operationId="GetFeedbacks",
     *     summary="Get list of feedbacks",
     *     description="",
     *     @OA\Parameter(ref="#/components/parameters/pagination-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-per-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-by"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-dir"),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User id of feedbacks to return",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Type of feedbacks to return",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Feedback")
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
    public function index(FeedbackGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'user_id' => $request->user_id ?? null,
            'type' => $request->type ?? null,
            'id' => $request->id ?? null
        ];
        $records = app('GetFeedback')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/feedbacks/{id}",
     *     tags={"Feedback"},
     *     operationId="GetFeedback",
     *     summary="Get feedback by id",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of feedback to return",
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
     *             @OA\Items(ref="#/components/schemas/Feedback")
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
    public function show(FeedbackGetRequest $request)
    {
        return $this->index($request);
    }

    /**
     * @OA\Post(
     *     path="/api/feedbacks",
     *     tags={"Feedback"},
     *     operationId="PostFeedback",
     *     summary="Store feedback to system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Feedback store request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/FeedbackStoreRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/FeedbackStoreRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Feedback")
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
    public function store(FeedbackStoreRequest $request)
    {
        $records = app('StoreFeedback')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Put(
     *     path="/api/feedbacks/{id}",
     *     tags={"Feedback"},
     *     operationId="PutFeedback",
     *     summary="Update feedback in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of feedback to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Feedback update request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/FeedbackUpdateRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/FeedbackUpdateRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Feedback")
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
    public function update(FeedbackUpdateRequest $request)
    {
        $records = app('UpdateFeedback')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Delete(
     *     path="/api/feedbacks/{id}",
     *     tags={"Feedback"},
     *     operationId="DeleteFeedback",
     *     summary="Delete feedback in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of feedback to update",
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
     *             @OA\Items(ref="#/components/schemas/Feedback")
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
    public function destroy(FeedbackDestroyRequest $request)
    {
        $records = app('DestroyFeedback')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
