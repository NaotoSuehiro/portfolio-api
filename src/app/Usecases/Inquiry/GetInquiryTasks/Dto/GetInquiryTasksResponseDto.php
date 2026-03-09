<?php

namespace App\Usecases\Inquiry\GetInquiryTasks\Dto;

use App\Usecases\Inquiry\GetInquiryTasks\Dto\InquiryTaskItemDto;

class GetInquiryTasksResponseDto
{
    /**
     * @param InquiryTaskItemDto[] $data
     */
    public function __construct(
        public readonly array $data,
        public readonly int $totalCount
    ) {}
}
