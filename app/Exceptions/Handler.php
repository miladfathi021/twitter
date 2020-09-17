<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

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
    protected $dontFlash
        = [
            'password',
            'password_confirmation',
        ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     *
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            throw new NotFoundException();
        }

        if ($exception instanceof \Illuminate\Database\QueryException) {
            throw new DatabaseQueryException();
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            throw ((new ValidationException())->setData($exception->errors()));
        }

        if ($exception instanceof AuthorizationException) {
            throw ((new \App\Exceptions\AuthorizationException()));
        }

        if ($exception instanceof ModelNotFoundException) {
            throw new \App\Exceptions\NotFoundHttpException();
        }

        if ($exception instanceof AuthenticationException) {
            throw new UnauthenticatedException();
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            throw new MethodNotAllowedException();
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
