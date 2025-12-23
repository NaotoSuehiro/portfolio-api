<?php

namespace App\Usecases\User\GetUserList\Dto;

class GetUserListRequestDto
{
    public function __construct(
        public readonly ?string $email,
        public readonly ?string $userName,
        public readonly int $limit,
        public readonly int $page,
    ) {}
}
