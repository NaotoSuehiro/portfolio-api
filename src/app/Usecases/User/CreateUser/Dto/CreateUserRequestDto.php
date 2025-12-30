<?php

namespace App\Usecases\User\CreateUser\Dto;

class CreateUserRequestDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $userName
    ) {}
}
