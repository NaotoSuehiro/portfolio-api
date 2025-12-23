<?php

declare(strict_types=1);

namespace App\Usecases\User\GetUserList;

use App\Domain\User\Interface\UserQueryInterface;
use App\Usecases\User\GetUserList\Dto\GetUserListRequestDto;
use App\Usecases\User\GetUserList\Dto\GetUserListResponseDto;

class GetUserListUsecase
{
    public function __construct(
        private readonly UserQueryInterface $userQuery
    ) {}

    public function handle(GetUserListRequestDto $dto): GetUserListResponseDto
    {
        return $this->userQuery->fetchUserList($dto);
    }
}
