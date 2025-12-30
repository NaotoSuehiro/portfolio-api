<?php

namespace App\Domain\User\Interface;

use App\Usecases\User\GetUserList\Dto\GetUserListResponseDto;
use App\Usecases\User\GetUserList\Dto\GetUserListRequestDto;

interface UserQueryInterface
{
    public function fetchUserList(GetUserListRequestDto $dto): GetUserListResponseDto;
}
