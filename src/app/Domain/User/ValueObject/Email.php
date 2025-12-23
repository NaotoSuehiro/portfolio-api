<?php

namespace App\Domain\User\ValueObject;

use App\Domain\Common\ValueObject\ValueObjectInterface;
use App\Domain\Common\ValueObject\ValueObjectTrait;
use App\Exceptions\DomainException;

class Email implements ValueObjectInterface
{
    use ValueObjectTrait;

    private function __construct(private readonly string $value) {}

    public static function create(string $value): self
    {
        self::validate($value);
        return new self($value);
    }

    public static function reconstruct(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    private static function validate(string $value): void
    {
        if (trim($value) === '') {
            throw new DomainException('ログインIDは空欄にできません');
        }

        //半角英数字記号のみ
        if (!preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/', $value)) {
            throw new DomainException('メールアドレスの形式が正しくありません');
        }
    }
}
