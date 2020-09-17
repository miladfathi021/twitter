<?php

namespace App\Exceptions;

use Exception;

class UnauthenticatedException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => 'Unauthenticated Exception',
        ], 401);
    }
}
