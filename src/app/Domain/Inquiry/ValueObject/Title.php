<?php

namespace App\Domain\Inquiry\ValueObject;

use App\Domain\Common\ValueObject\ValueObjectInterface;
use App\Domain\Common\ValueObject\ValueObjectTrait;
use App\Exceptions\DomainException;

class Title implements ValueObjectInterface
{
    use ValueObjectTrait;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

     /**
     * 新規作成用（バリデーションあり）
     */
    public static function create(string $value): self
    {
        static::validate($value);
        return new self($value);
    }

    /**
     * 再構築用（DBからの復元）DBからの復元なのでバリデーションは通さない
     */
    public static function reconstruct(string $value): ?self
    {
        return new self($value);
    }

    /*** 文字列としての値を取得*/
    public function value(): string
    {
        return $this->value;
    }

    /*** ドメインに変換*/
    public static function fromString(string $value): self
    {
        static::validate($value);
        return new self($value);
    }

    private static function validate(string $value): void
    {
        if (empty($value)) {
                throw new DomainException("タイトルを入力してください");
        }
    }
}
