<?php

namespace App\Domain\Common\Entity;

use App\Domain\Common\ValueObject\ValueObjectInterface;

trait EntityTrait
{
    public function equals(EntityInterface $other): bool
    {
        if (!$other instanceof static) {
            return false;
        }
        return $this->id()->equals($other->id());
    }

    abstract public function id(): ValueObjectInterface;
}
