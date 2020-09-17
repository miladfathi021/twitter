<?php

namespace App\Exceptions;

use Exception;

class NotDeletable extends Exception
{
    public function render()
    {
        return response()->json([
            'status' => ExceptionStatusManager::get(static::class),
            'error' => true,
            'message' => $this->getMessage(),
        ], 401);
    }
}
