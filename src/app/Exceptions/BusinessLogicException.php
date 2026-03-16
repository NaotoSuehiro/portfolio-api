<?php

namespace App\Exceptions;

use Exception;

abstract class BusinessLogicException extends Exception
{

  protected string $errorCode = 'BUSINESS_ERROR';
  protected int $httpStatus = 400;

  public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    public function getErrorMessage(): string
    {
        return $this->getMessage() ?: $this->getDefaultErrorMessage();
    }

    protected function getDefaultErrorMessage(): string
    {
        return 'エラーが発生しました。';
    }
}
