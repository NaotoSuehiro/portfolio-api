<?php

namespace App\Exceptions;

class DomainException extends BusinessLogicException
{
    public function getErrorCode(): string
    {
        return 'DOMAIN_ERROR';
    }
}
