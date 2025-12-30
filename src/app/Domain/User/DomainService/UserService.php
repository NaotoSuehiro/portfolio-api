<?php

namespace App\Domain\User\DomainService;

use App\Domain\User\ValueObject\Email;
use App\Domain\User\Interface\UserRepositoryInterface;
use App\Exceptions\ValidationException;

class UserService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    //メールアドレスの一意性を保証する
    public function ensureUniqueEmail(Email $email): void
    {
        $email = $this->userRepository->findByEmail($email);

        if ($email) {
            throw new ValidationException('既に同じメールアドレスが使用されています。');
        }
    }
}
