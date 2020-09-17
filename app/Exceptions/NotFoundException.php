<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => 'Not Found',
        ], 401);
    }
}
