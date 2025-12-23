<?php

namespace App\Usecases\User\GetUser\Dto;

class GetUserResponseDto
{
    public function __construct(
        public readonly string $userId,
        public readonly string $userName,
        public readonly string $email
    ) {}
}
