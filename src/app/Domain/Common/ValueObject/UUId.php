<?php

namespace App\Domain\Common\ValueObject;

use App\Domain\Common\ValueObject\ValueObjectInterface;
use App\Domain\Common\ValueObject\ValueObjectTrait;
use App\Exceptions\DomainException;
use Illuminate\Support\Str;

class UUId implements ValueObjectInterface
{
    use ValueObjectTrait;

    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function generate(): self
    {
        return new self(Str::uuid()->toString());
    }

    public static function create(string $value): self
    {
        self::ensureIsValidUuid($value);
        return new self($value);
    }

    public static function reconstruct(string $value): self
    {
        return new self($value);
    }

    private static function ensureIsValidUuid(string $value): void
    {
        if (!Str::isUuid($value)) {
            throw new DomainException("UUIDの形式が正しくありません");
        }
    }
}
