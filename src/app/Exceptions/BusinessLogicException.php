<?php

namespace App\Exceptions;

use Exception;

/**
 * 
 * DatabaseOperationException
 * 説明: データベース操作中に予期せぬエラーが発生した場合に使用します。
 * 使用例: データの保存や取得中にデータベース接続が失われた場合。
 * HTTP ステータスコード: 500 Internal Server Error
 * 
 * ExternalApiExceptionException
 * 説明: 外部APIの呼び出し中に予期せぬエラーが発生した場合に使用します。
 * 使用例: 外部APIの呼び出し中にネットワークエラーが発生した場合。
 * HTTP ステータスコード: 500 Internal Server Error
 * 
 * DomainException
 * 説明: ドメインロジック内でビジネスルールに違反する操作が行われた場合に使用します。
 * 使用例: 特定の状態のメッセージに対して許可されていない操作を行おうとした場合。
 * HTTP ステータスコード: 400 Bad Request
 * 
 * ValidationException
 * 説明: 入力データがシステムの要求を満たしていない場合に使用します。
 * 使用例: 必須フィールドが空である、または無効な形式のデータが提供された場合。
 * HTTP ステータスコード: 422 Unprocessable Entity
 * 
 */
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
