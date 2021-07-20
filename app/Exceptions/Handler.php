<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;

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
        'current_password',
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException){
            return response()->json([
                'success' => false,
                'message' => 'Not Found.',
                'data' => null
            ],Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof HttpException){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => null
            ],$exception->getStatusCode());
        }


        if ($exception instanceof QueryException)
        {
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error.',
                'data' => null
            ], 500);
        }

        if ($exception instanceof ErrorException)
        {
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error.',
                'data' => null
            ], 500);
        }

        return parent::render($request, $exception);
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'success' => false,
            'message'=> "Unauthorized.",
            'data' => null
        ], 401);
    }
}
