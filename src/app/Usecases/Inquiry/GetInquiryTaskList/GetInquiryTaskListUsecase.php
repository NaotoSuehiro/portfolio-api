<?php

declare(strict_types=1);

namespace App\Usecases\Inquiry\GetInquiryTaskList;

use App\Domain\Inquiry\Interface\InquiryQueryInterface;
use App\Usecases\Inquiry\GetInquiryTaskList\Dto\GetInquiryTaskListRequestDto;
use App\Usecases\Inquiry\GetInquiryTaskList\Dto\GetInquiryTaskListResponseDto;
use App\Exceptions\ValidationException;

class GetInquiryTaskListUsecase
{
    public function __construct(
        private readonly InquiryQueryInterface $inquiryQuery
    ) {}

    public function handle(GetInquiryTaskListRequestDto $dto): GetInquiryTaskListResponseDto
    {
        return $this->inquiryQuery->fetchInquiryTaskList($dto);
    }
}
