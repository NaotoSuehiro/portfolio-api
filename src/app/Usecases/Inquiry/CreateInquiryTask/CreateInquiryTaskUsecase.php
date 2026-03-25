<?php

declare(strict_types=1);

namespace App\Usecases\Inquiry\CreateInquiryTask;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\Factory\InquiryFactory;
use App\Domain\Inquiry\Interface\InquiryRepositoryInterface;
use App\Domain\User\DomainService\UserService;
use App\Exceptions\ResourceNotFoundException;
use App\Usecases\Inquiry\CreateInquiryTask\Dto\CreateInquiryTaskRequestDto;

class CreateInquiryTaskUsecase
{
    public function __construct(
        private readonly InquiryRepositoryInterface $inquiryRepository,
        private readonly UserService $userService,
        private readonly InquiryFactory $inquiryFactory,
    ) {}

    public function handle(CreateInquiryTaskRequestDto $dto): void
    {

        //更新対象者を取得
        $userId = UUId::create($dto->userId);
        $this->userService->ensureUserExist($userId);

        //インスタンス生成
        $inquiryTask = $this->inquiryFactory->createTask(
            title: $dto->title,
            content: $dto->content,
            status: $dto->status,
            userId: $dto->userId
        );

        //新規作成
        $this->inquiryRepository->createTask($inquiryTask);
    }
}
