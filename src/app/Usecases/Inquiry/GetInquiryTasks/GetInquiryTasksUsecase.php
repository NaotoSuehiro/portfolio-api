<?php

declare(strict_types=1);

namespace App\Usecases\Inquiry\GetInquiryTasks;

use App\Domain\Inquiry\Interface\InquiryQueryInterface;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksRequestDto;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksResponseDto;

class GetInquiryTasksUsecase
{
    public function __construct(
        private readonly InquiryQueryInterface $inquiryQuery
    ) {}

    public function handle(GetInquiryTasksRequestDto $dto): GetInquiryTasksResponseDto
    {
        return $this->inquiryQuery->fetchInquiryTasks($dto);
    }
}
