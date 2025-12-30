<?php

declare(strict_types=1);

namespace App\Usecases\User\DeleteUser;

use App\Domain\User\Interface\UserRepositoryInterface;
use App\Exceptions\ResourceNotFoundException;
use App\Usecases\User\DeleteUser\Dto\DeleteUserRequestDto;
use App\Domain\Common\ValueObject\UUId;

class DeleteUserUsecase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    public function handle(DeleteUserRequestDto $dto): void
    {

        //削除対象者を取得
        $userId = UUId::create($dto->userId);
        $user   = $this->userRepository->findById($userId);

        if (!$user) {
            throw new ResourceNotFoundException('ユーザーの取得に失敗しました。');
        }

        //削除処理
        $deleted_user = $this->userRepository->delete($user);
    }
}
