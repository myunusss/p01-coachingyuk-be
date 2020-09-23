<?php

namespace App\Exceptions;

use App\Helpers\APIResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;
use Exception;
use ReflectionException;
use URL;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return APIResponse::json([
                'code' => NOT_FOUND_CODE,
                'status' => NOT_FOUND_STATUS,
                'message' => $e->getMessage()
            ], NOT_FOUND_CODE);
        }

        if ($e instanceof RouteNotFoundException) {
            return APIResponse::json([
                'code' => UNAUTHORIZED_CODE,
                'status' => UNAUTHORIZED_STATUS,
                'message' => $e->getMessage()
            ], UNAUTHORIZED_CODE);
        }


        if ($e instanceof BindingResolutionException) {
            return APIResponse::json([
                'code' => FAILURE_CODE,
                'status' => FAILURE_STATUS,
                'message' => $e->getMessage()
            ], FAILURE_CODE);
        }

        if ($e instanceof ReflectionException) {
            return APIResponse::json([
                'code' => FAILURE_CODE,
                'status' => FAILURE_STATUS,
                'message' => $e->getMessage()
            ], FAILURE_CODE);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return APIResponse::json([
                'code' => FAILURE_CODE,
                'status' => FAILURE_STATUS,
                'message' => $e->getMessage()
            ], FAILURE_CODE);
        }

        if ($e instanceof ModelNotFoundException && $request->wantsJson()) {
            return APIResponse::json([
                'code' => FAILURE_CODE,
                'status' => FAILURE_STATUS,
                'message' => $e->getMessage()
            ], FAILURE_CODE);
        }

        return parent::render($request, $e);
    }
}
