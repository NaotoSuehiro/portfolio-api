<?php

namespace App\Exceptions;

class ResourceNotFoundException extends BusinessLogicException
{
    public function getErrorCode(): string
    {
        return 'RESOURCE_NOT_FOUND';
    }
}
