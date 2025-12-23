<?php

namespace App\Domain\Common\ValueObject;

trait ValueObjectTrait
{
    public function equals(ValueObjectInterface $other): bool
    {
        if (get_class($this) !== get_class($other)) {
            return false;
        }
        return $this->value() === $other->value();
    }
}
