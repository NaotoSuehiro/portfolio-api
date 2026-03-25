<?php

declare(strict_types=1);

namespace App\Usecases\InquiryComment\CreateInquiryComment;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\Factory\InquiryFactory;
use App\Domain\Inquiry\Interface\InquiryRepositoryInterface;
use App\Domain\User\DomainService\UserService;
use App\Exceptions\ResourceNotFoundException;
use App\Usecases\InquiryComment\CreateInquiryComment\Dto\CreateInquiryCommentRequestDto;

class CreateInquiryCommentUsecase
{
    public function __construct(
        private readonly InquiryRepositoryInterface $inquiryRepository,
        private readonly UserService $userService,
        private readonly InquiryFactory $inquiryFactory,
    ) {}

    public function handle(CreateInquiryCommentRequestDto $dto): void
    {

        //更新対象者を取得
        $userId = UUId::create($dto->userId);
        $this->userService->ensureUserExist($userId);

        //インスタンス生成
        $InquiryComment = $this->inquiryFactory->createComment(
            inquiryTaskId: $dto->inquiryTaskId,
            userId: $dto->userId,
            comment: $dto->comment
        );

        //新規作成
        $this->inquiryRepository->createComment($InquiryComment);
    }
}
