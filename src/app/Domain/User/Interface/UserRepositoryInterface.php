<?php

declare(strict_types=1);

namespace App\Domain\User\Interface;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Email;


interface UserRepositoryInterface
{

    public function findById(UUId $id): ?User;

    public function findByEmail(Email $email): ?User;

    public function create(User $user): void;

    public function update(User $user): void;

    public function delete(User $user): void;
}
