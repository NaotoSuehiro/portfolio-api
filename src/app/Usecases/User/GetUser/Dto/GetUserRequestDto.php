<?php

namespace App\Usecases\User\GetUser\Dto;

class GetUserRequestDto
{
    public function __construct(
        public readonly string $userId
    ) {}
}
