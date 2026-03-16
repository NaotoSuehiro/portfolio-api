<?php

namespace App\Exceptions;


class ValidationException extends BusinessLogicException
{
/**
 * ValidationException
 * 説明: 入力データがシステムの要求を満たしていない場合に使用します。
 * 使用例: 必須フィールドが空である、または無効な形式のデータが提供された場合。
 */
    protected string $errorCode = 'VALIDATION_ERROR';
    protected int $httpStatus = 422;

    public function getErrorCode(): string
    {
        return '入力値に異常がありました';
    }
}
