<?php

namespace App\Usecases\User\GetUserList\Dto;

use App\Usecases\User\GetUserList\Dto\UserListItemDto;

class GetUserListResponseDto
{
    /**
     * @param UserListItemDto[] $data
     */
    public function __construct(
        public readonly array $data,
        public readonly int $totalCount
    ) {}
}
