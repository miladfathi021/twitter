<?php

namespace App\Exceptions;

class ExceptionStatusManager
{
    public static $statuses = [
        DatabaseQueryException::class => 1,
        ValidationException::class => 2,
        AuthorizationException::class => 3,
        NotFoundHttpException::class => 4,
        UnauthenticatedException::class => 9,
        NotFoundException::class => 10,
        MethodNotAllowedException::class => 11,
        InvalidFile::class => 14,
        NotDeletable::class => 20,
        CodeBoundary::class => 21,
    ];

    /**
     * Get a local status number for an exception.
     *
     * @param $exceptionType
     *
     * @return int
     */
    public static function get($exceptionType): int
    {
        return self::$statuses[$exceptionType];
    }
}
