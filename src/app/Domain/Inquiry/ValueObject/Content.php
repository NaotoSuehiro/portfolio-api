<?php

namespace App\Domain\Inquiry\ValueObject;

use App\Domain\Common\ValueObject\ValueObjectInterface;
use App\Domain\Common\ValueObject\ValueObjectTrait;
use App\Domain\Common\ValueObject\ValueObjectStringTrait;
use App\Exceptions\DomainException;

class Content implements ValueObjectInterface
{
    use ValueObjectStringTrait;

    private static function validate(string $value): void
    {
        if (empty($value)) {
            throw new DomainException("問い合わせ内容を入力してください");
        }
    }
}