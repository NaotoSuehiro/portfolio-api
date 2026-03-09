<?php

namespace App\Domain\Inquiry\ValueObject;

use App\Domain\Common\ValueObject\ValueObjectInterface;
use App\Domain\Common\ValueObject\ValueObjectTrait;
use App\Domain\Common\ValueObject\ValueObjectStringTrait;
use App\Exceptions\DomainException;

class Title implements ValueObjectInterface
{
    use ValueObjectStringTrait;

    private static function validate(string $value): void
    {
        if (empty($value)) {
                throw new DomainException("タイトルを入力してください");
        }
    }
}
