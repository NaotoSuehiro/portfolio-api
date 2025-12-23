<?php

namespace App\Usecases\User\UpdateUser\Dto;

class UpdateUserRequestDto
{
    public function __construct(
        public readonly string $userId,
        public readonly string $email,
        public readonly string $userName,
        public readonly string $password
    ) {}
}
