<?php

namespace App\Exceptions;

class DatabaseOperationException extends BusinessLogicException
{
    public function getErrorCode(): string
    {
        return 'DATABASE_ERROR';
    }
}
