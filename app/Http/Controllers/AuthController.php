<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     operationId="authLogin",
     *     summary="Authenticate user to the system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Login request object that needs to be authenticated",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/AuthLoginRequest"),
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
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     * )
     */
    public function login(AuthLoginRequest $request)
    {
        $records = app('Login')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = UNAUTHORIZED_CODE;
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     operationId="authRegister",
     *     summary="Register new user to the system",
     *     description="",
     *     @OA\RequestBody(
     *         description="Register request object that needs to be authenticated",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthRegisterRequest"),
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/AuthRegisterRequest"),
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
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     * )
     */
    public function register(AuthRegisterRequest $request)
    {
        $records = app('Register')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = UNAUTHORIZED_CODE;
        return APIResponse::json($records, $code);
    }
}
