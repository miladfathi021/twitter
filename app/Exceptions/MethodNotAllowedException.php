<?php

namespace App\Exceptions;

use Exception;

class MethodNotAllowedException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => 'Not Allowed',
        ], 401);
    }
}
