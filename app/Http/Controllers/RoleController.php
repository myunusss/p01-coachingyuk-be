<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Role\RoleDestroyRequest;
use App\Http\Requests\Role\RoleGetRequest;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/roles",
     *     tags={"Role"},
     *     operationId="GetRoles",
     *     summary="Get list of roles",
     *     description="",
     *     @OA\Parameter(ref="#/components/parameters/pagination-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-per-page"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-by"),
     *     @OA\Parameter(ref="#/components/parameters/pagination-sort-dir"),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
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
    public function index(RoleGetRequest $request)
    {
        $filter = [
            'page' => $request->page ?? 1,
            'per_page' => $request->per_page ?? 10,
            'sort_by' => $request->sort_by ?? 'created_at',
            'sort_dir' => $request->sort_dir ?? 'desc',
            'id' => $request->id ?? null
        ];
        $records = app('GetRole')->execute($filter);
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/roles/{id}",
     *     tags={"Role"},
     *     operationId="GetRole",
     *     summary="Get role by id",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of role to return",
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
     *             @OA\Items(ref="#/components/schemas/Role")
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
    public function show(RoleGetRequest $request)
    {
        return $this->index($request);
    }

    /**
     * @OA\Post(
     *     path="/api/roles",
     *     tags={"Role"},
     *     operationId="PostRole",
     *     summary="Store role to system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Role store request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RoleStoreRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/RoleStoreRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
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
    public function store(RoleStoreRequest $request)
    {
        $records = app('StoreRole')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Put(
     *     path="/api/roles/{id}",
     *     tags={"Role"},
     *     operationId="PutRole",
     *     summary="Update role in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of role to update",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Role update request object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RoleUpdateRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/RoleUpdateRequest"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
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
    public function update(RoleUpdateRequest $request)
    {
        $records = app('UpdateRole')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Delete(
     *     path="/api/roles/{id}",
     *     tags={"Role"},
     *     operationId="DeleteRole",
     *     summary="Delete role in system",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of role to update",
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
     *             @OA\Items(ref="#/components/schemas/Role")
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
    public function destroy(RoleDestroyRequest $request)
    {
        $records = app('DestroyRole')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = FAILURE_CODE;
        return APIResponse::json($records, $code);
    }
}
