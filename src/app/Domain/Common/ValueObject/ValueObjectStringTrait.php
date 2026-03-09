<?php

namespace App\Domain\Common\ValueObject;
use App\Domain\Common\ValueObject\ValueObjectInterface;

trait ValueObjectStringTrait
{
    private function __construct(private readonly string $value) {}

    /**
     * 新規作成用（バリデーションあり）
     */
    public static function create(string $value): self
    {
        static::validate($value);
        return new self($value);
    }

    /**
     * 再構築用（DBからの復元）
     * null許容
     */
    public static function reconstruct(?string $value): ?self
    {
        if ($value === null) {
            return null;
        }
        // DBからの復元なのでバリデーションは通さない
        return new self($value);
    }

    /*** 文字列としての値を取得*/
    public function value(): string
    {
        return $this->value;
    }

    /*** 比較用*/
    public function equals(ValueObjectInterface $other): bool
    {
        if (!$other instanceof self) {
            return false;
        }
        return $this->value === $other->value;
    }

    /*** ドメインに変換*/
    public static function fromString(string $value): self
    {
        static::validate($value);
        return new self($value);
    }

    /*** ドメインに変換】 NULL許容の場合に使用*/
    public static function fromNullableString(?string $value): ?self
    {
        if ($value === null || $value === '') {
            return null;
        }
        return self::fromString($value);
    }
}