<?php

declare(strict_types=1);

namespace App\Usecases\User\CreateUser;

use App\Domain\User\Factory\UserFactory;
use App\Domain\User\Interface\UserRepositoryInterface;
use App\Domain\User\DomainService\UserService;
use App\Exceptions\DatabaseOperationException;
use App\Domain\User\ValueObject\Email;
use App\Helpers\Auth\AuthZHelper;
use App\Usecases\User\CreateUser\Dto\CreateUserRequestDto;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CreateUserUsecase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserFactory $userFactory,
        private readonly UserService $userService,
    ) {}

    public function handle(CreateUserRequestDto $dto): void
    {

        //ユニークなログインアカウントか検証
        $email = Email::create($dto->email);
        $this->userService->ensureUniqueEmail($email);

        //インスタンス生成
        $user = $this->userFactory->create(
            email: $dto->email,
            password: $dto->password,
            userName: $dto->userName
        );

        //新規作成
        $this->userRepository->create($user);
    }
}
