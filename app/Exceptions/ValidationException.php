<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends CustomException
{
    public function render($request)
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => 'Given data is invalid',
            'data' => $this->data
        ], 400);
    }
}
