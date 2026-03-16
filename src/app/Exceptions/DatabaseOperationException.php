<?php

namespace App\Exceptions;

class DatabaseOperationException extends BusinessLogicException
{
/**
 * 
 * DatabaseOperationException
 * 説明: データベース操作中に予期せぬエラーが発生した場合に使用します。
 * 使用例: データの保存や取得中にデータベース接続が失われた場合。
 * HTTP ステータスコード: 500 Internal Server Error
 */
    protected string $errorCode = 'DATABASE_ERROR';
    protected int $httpStatus = 500;

    public function getErrorCode(): string
    {
        return 'データベースにアクセスできませんでした';
    }
}
