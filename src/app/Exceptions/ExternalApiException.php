<?php

namespace App\Exceptions;

class ExternalApiException extends BusinessLogicException
{/**
 * 
 * ExternalApiExceptionException
 * 説明: 外部APIの呼び出し中に予期せぬエラーが発生した場合に使用します。
 * 使用例: 外部APIの呼び出し中にネットワークエラーが発生した場合。
 */
    protected string $errorCode = 'API_ERROR';
    protected int $httpStatus = 400;
    public function getErrorCode(): string
    {
        return 'APIにうまくアクセスできませんでした';
    }
}
