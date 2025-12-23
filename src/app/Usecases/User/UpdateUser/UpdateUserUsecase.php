<?php

declare(strict_types=1);

namespace App\Usecases\User\UpdateUser;

use App\Domain\User\Interface\UserRepositoryInterface;
use App\Domain\User\Factory\UserFactory;
use App\Domain\User\DomainService\UserService;
use App\Usecases\User\UpdateUser\Dto\UpdateUserRequestDto;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserPassword;
use App\Exceptions\ResourceNotFoundException;
use App\Domain\Common\ValueObject\UUId;

class UpdateUserUsecase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserFactory $userFactory,
        private readonly UserService $userService
    ) {}

    public function handle(UpdateUserRequestDto $dto): void
    {
        //更新対象者を取得
        $userId = UUId::create($dto->userId);
        $user   =  $this->userRepository->findById($userId);

        if (!$user) {
            throw new ResourceNotFoundException('ユーザーの取得に失敗しました。');
        }

        //ユーザー名
        if($dto->userName){
            $user->updateUserName($dto->userName);
        }

        //パスワード
        if($dto->password){
            $password = UserPassword::create($dto->password);
            $user->updateUserPassword($password);
        }

        //メールアドレス
        $beforeEmail = $user->email();
        $afterEmail  = Email::create($dto->email);

        //メールアドレスの一意性チェック
        if (!$afterEmail->equals($beforeEmail)) {
            $this->userService->ensureUniqueEmail(
                email: $afterEmail
            );
             $user->updateEmail($afterEmail);
        }
        $this->userRepository->update($user);
    }
}
