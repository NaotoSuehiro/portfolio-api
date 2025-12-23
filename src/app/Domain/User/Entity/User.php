<?php

namespace App\Domain\User\Entity;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserPassword;
use App\Domain\Common\Entity\EntityInterface;
use App\Domain\Common\Entity\EntityTrait;

class User implements EntityInterface
{
    use EntityTrait;

    public function __construct(
        private UUId $id,
        private Email $email,
        private UserPassword $password,
        private string $userName
    ) {}

    public function id(): UUId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function userPassword(): UserPassword
    {
        return $this->password;
    }

    public function userName(): string
    {
        return $this->userName;
    }


    /*更新系**********************************************/
    public function updateEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function updateUserPassword(UserPassword $password): void
    {
        $this->password = $password;
    }

    public function updateUserName(string $userName): void
    {
        $this->userName = $userName;
    }
}
