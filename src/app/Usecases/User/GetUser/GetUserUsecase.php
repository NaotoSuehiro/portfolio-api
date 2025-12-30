<?php

declare(strict_types=1);

namespace App\Usecases\User\GetUser;

use App\Domain\User\Interface\UserRepositoryInterface;
use App\Usecases\User\GetUser\Dto\GetUserRequestDto;
use App\Usecases\User\GetUser\Dto\GetUserResponseDto;
use App\Domain\Common\ValueObject\UUId;
use App\Exceptions\ResourceNotFoundException;

class GetUserUsecase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function handle(GetUserRequestDto $dto): ?GetUserResponseDto
    {

        /*対象者を取得***************************************/
        $userId = UUId::create($dto->userId);
        $user   =  $this->userRepository->findById($userId);

        if (!$user) {
            throw new ResourceNotFoundException('ユーザーの取得に失敗しました。');
        }

        //レスポンスDTO作成*********************************/
        $response = new  GetUserResponseDto(
            userId: $user->id()->value(),
            userName: $user->userName(),
            email: $user->email()->value()
        );

        return  $response;
    }
}
