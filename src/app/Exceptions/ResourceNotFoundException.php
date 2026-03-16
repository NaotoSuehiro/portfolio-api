<?php

namespace App\Exceptions;

class ResourceNotFoundException extends BusinessLogicException
{/**
 * 
 * DatabaseOperationException
 * 説明: DBに存在しないデータがある場合などに使用します。
 * 使用例: 更新時に指定したIDがない場合。
 */
    protected string $errorCode = 'RESOURCE_NOT_FOUND';
    protected int $httpStatus = 404;

    public function getErrorCode(): string
    {
        return 'データが見つかりませんでした';
    }
}
