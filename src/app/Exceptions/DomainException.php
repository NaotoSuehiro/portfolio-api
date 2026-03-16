<?php

namespace App\Exceptions;

class DomainException extends BusinessLogicException
{
/**
 * DomainException
 * 説明: ドメインロジック内でビジネスルールに違反する操作が行われた場合に使用します。
 * 使用例: 特定の状態のメッセージに対して許可されていない操作を行おうとした場合。
 */
   protected string $errorCode = 'DOMAIN_ERROR';
   protected int $httpStatus = 400;

    public function getErrorCode(): string
    {
        return 'ビジネスロジックに違反がありました';
    }

}