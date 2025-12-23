<?php

namespace App\Domain\Common\Entity;

use App\Domain\Common\ValueObject\ValueObjectInterface;

interface EntityInterface
{
    /**
     * Get the identity of the entity.
     *
     * @return ValueObjectInterface
     */
    public function id(): ValueObjectInterface;

    /**
     * Check if this entity is equal to another.
     *
     * @param EntityInterface $other
     * @return bool
     */
    public function equals(EntityInterface $other): bool;
}
