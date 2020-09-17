<?php

namespace App\Exceptions;

use Exception;

class NotFoundHttpException extends \Exception
{
    public function render($request)
    {
       return  response() ->json([
           'status' => ExceptionStatusManager::get(static::class),
           'error' => true,
           'message' => 'Requested Resource Not Found',
       ], 401);
    }
}
