<?php

declare(strict_types=1);

namespace App\Usecases\Inquiry\GetInquiryTask;

use App\Domain\Inquiry\Interface\InquiryQueryInterface;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskRequestDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskResponseDto;
use App\Exceptions\ValidationException;

class GetInquiryTaskUsecase
{
    public function __construct(
        private readonly InquiryQueryInterface $inquiryQuery
    ) {}

    public function handle(GetInquiryTaskRequestDto $dto): GetInquiryTaskResponseDto
    {
        return $this->inquiryQuery->fetchInquiryTaskDetail($dto);
    }
}
