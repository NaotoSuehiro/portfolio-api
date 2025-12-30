<?php

namespace App\Exceptions;


class ValidationException extends BusinessLogicException
{
    public function getErrorCode(): string
    {
        return 'VALIDATION_ERROR';
    }
}
