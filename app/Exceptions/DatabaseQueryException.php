<?php

namespace App\Exceptions;

class DatabaseQueryException extends \Exception
{
    public function render($request)
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => 'Query Exception',
        ], 401);
    }
}
