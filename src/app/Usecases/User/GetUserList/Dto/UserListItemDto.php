<?php

namespace App\Usecases\User\GetUserList\Dto;

class UserListItemDto
{
    public function __construct(
        public readonly string $userId,
        public readonly string $userName,
        public readonly string $email,
    ) {}
}
