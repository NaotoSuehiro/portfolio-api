<?php

namespace App\Exceptions;

class ExternalApiException extends BusinessLogicException
{
    public function getErrorCode(): string
    {
        return 'EXTERNAL_API_ERROR';
    }
}
