<?php

namespace App\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    public function render($request)
    {
       return response() ->json([
           'status' => ExceptionStatusManager::get(static::class),
           'error' => true,
           'message' => 'Authorization failed'
       ], 401);
    }
}
