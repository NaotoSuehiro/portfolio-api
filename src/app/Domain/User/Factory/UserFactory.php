<?php

namespace App\Domain\User\Factory;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserPassword;
use App\Domain\User\ValueObject\UserName;

class UserFactory
{
    public function create(
        string $email,
        string $password,
        string $userName
    ): User 
    {
        return new User(
            id: UUId::generate(),
            email: Email::create($email),
            password: UserPassword::create($password),
            userName: UserName::create($userName)
        );
    }

    public function reconstruct(
        string $userId,
        string $email,
        string $password,
        string $userName
    ): User 
    {
        return new User(
            id: UUId::reconstruct($userId),
            email: Email::reconstruct($email),
            password: UserPassword::reconstruct($password),
            userName:UserName::reconstruct($userName)
        );
    }
}
