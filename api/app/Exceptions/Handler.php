<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $data = [];
        $message = $exception->getMessage();
        $code = $exception->getCode();
        if ($exception instanceof ValidationException) {
            $data = json_decode($exception->getResponse()->getContent());
            $code = Response::HTTP_UNPROCESSABLE_ENTITY;
        } else {
            if ($exception instanceof \PDOException) {
                if (!env('APP_DEBUG')) {
                    $message = 'There is unexpected issue occurred. Please try again or contact our support.';
                }
                $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            }
        }
        return response_api(
            $data,
            $code,
            $message
        );
    }
}
