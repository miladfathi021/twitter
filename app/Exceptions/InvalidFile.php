<?php

namespace App\Exceptions;

use Exception;

class InvalidFile extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => 'Invalid File Type',
        ], 401);
    }
}
