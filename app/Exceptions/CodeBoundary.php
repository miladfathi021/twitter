<?php

namespace App\Exceptions;

use Exception;

class CodeBoundary extends Exception
{
    public function render($request)
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => 'Error code boundary',
        ], 401);
    }
}
