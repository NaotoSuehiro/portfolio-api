<?php

namespace App\Usecases\User\DeleteUser\Dto;

class DeleteUserRequestDto
{
    public function __construct(
        public readonly string $userId
    ) {}
}
