<?php

namespace App\Domain\Common\ValueObject;

interface ValueObjectInterface
{
    /**
     * Get the primitive value of the value object.
     *
     * @return mixed
     */
    public function value();

    /**
     * Check if this value object is equal to another.
     *
     * @param ValueObjectInterface $other
     * @return bool
     */
    public function equals(ValueObjectInterface $other): bool;
}
