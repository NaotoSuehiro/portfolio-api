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
    abstract public function getErrorCode(): string;

    /**
     * エラーメッセージを取得する
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage() ?? $this->getDefaultErrorMessage();
    }

    /**
     * デフォルトのエラーメッセージを取得する
     */
    protected function getDefaultErrorMessage(): string
    {
        return match (get_class($this)) {
            DatabaseOperationException::class => 'データベース操作中にエラーが発生しました。',
            ExternalApiException::class => '外部APIの取得時にエラーが発生しました。',
            DomainException::class => 'ビジネスルール違反が発生しました。',
            ValidationException::class => '入力値が無効です。',
            ResourceNotFoundException::class => '指定されたリソースが見つかりません。',
            default => 'エラーが発生しました。しばらく経ってからもう一度お試しください。',
        };
    }
}
