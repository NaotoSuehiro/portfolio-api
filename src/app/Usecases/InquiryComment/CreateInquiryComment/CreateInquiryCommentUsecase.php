<?php

declare(strict_types=1);

namespace App\Usecases\InquiryComment\CreateInquiryComment;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\Factory\InquiryFactory;
use App\Domain\Inquiry\Interface\InquiryRepositoryInterface;
use App\Domain\User\DomainService\UserService;
use App\Domain\Inquiry\DomainService\InquiryService;
use App\Exceptions\ResourceNotFoundException;
use App\Usecases\InquiryComment\CreateInquiryComment\Dto\CreateInquiryCommentRequestDto;

class CreateInquiryCommentUsecase
{
    public function __construct(
        private readonly InquiryRepositoryInterface $inquiryRepository,
        private readonly UserService $userService,
        private readonly InquiryFactory $inquiryFactory,
        private readonly InquiryService $inquiryService
    ) {}

    public function handle(CreateInquiryCommentRequestDto $dto): void
    {

        //インスタンス生成
        $InquiryComment = $this->inquiryFactory->createComment(
            inquiryTaskId: $dto->inquiryTaskId,
            userId: $dto->userId,
            comment: $dto->comment
        );

        //問い合わせコメント作成
        $this->inquiryService->createNewComment($InquiryComment);
    }
}
