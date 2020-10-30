<?php

namespace App\Http\Controllers;

use App\Helpers\APIResponse;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\AuthResendEmailRequest;
use App\Http\Requests\Auth\AuthVerifyRequest;
use Laravel\Socialite\Facades\Socialite;

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
     *             mediaType="multipart/form-data",
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
     *             mediaType="multipart/form-data",
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
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = $records['code'];
        return APIResponse::json($records, $code);
    }

    /**
     * @OA\Get(
     *     path="/api/login/{provider}",
     *     tags={"Auth"},
     *     operationId="authProviderLogin",
     *     summary="Authenticate user to system via provider",
     *     description="",
     *     @OA\Parameter(
     *         name="provider",
     *         in="path",
     *         description="Provider used to authenticate",
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
     *             @OA\Items(ref="#/components/schemas/User")
     *         ),
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @OA\Get(
     *     path="/api/login/{provider}/callback",
     *     tags={"Auth"},
     *     operationId="authProviderLoginCallback",
     *     summary="Callback to authenticate user to system from provider",
     *     description="",
     *     @OA\Parameter(
     *         name="provider",
     *         in="path",
     *         description="Provider used to authenticate",
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
     *             @OA\Items(ref="#/components/schemas/User")
     *         ),
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $data = [
            'user' => $user,
            'provider' => $provider
        ];

        $records = app('ProviderLogin')->execute($data);
        return redirect(env('WEB_CALLBACK') . '?token=' . $records['data']['token']);
    }

    /**
     * @OA\Get(
     *     path="/api/verify",
     *     tags={"Auth"},
     *     operationId="verify",
     *     summary="Verify user email so user can log in to the system",
     *     description="",
     *     @OA\Parameter(
     *         name="token",
     *         in="query",
     *         description="Token sent to email used for verification",
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
     *             @OA\Items(ref="#/components/schemas/User")
     *         ),
     *     ),
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function verify(AuthVerifyRequest $request)
    {
        $records = app('Verify')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = $records['code'];
        return redirect($request->callback_url . '?data=' . base64_encode(json_encode($records['data'])));
    }

    /**
     * @OA\Post(
     *     path="/api/resend-email",
     *     tags={"Auth"},
     *     operationId="resendEmail",
     *     summary="Resend verification link to user email",
     *     description="",
     *     @OA\RequestBody(
     *         description="Resend Email request object that needs to be sent verification email",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthResendEmailRequest"),
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/AuthResendEmailRequest"),
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
     *     security={
     *         {"bearerAuth": {}}
     *     }
     * )
     */
    public function resendEmail(AuthResendEmailRequest $request)
    {
        $records = app('ResendVerificationEmail')->execute($request->all());
        ( $records['error'] == null ) ? $code = SUCCESS_CODE : $code = $records['code'];
        return APIResponse::json($records, $code);
    }
}
