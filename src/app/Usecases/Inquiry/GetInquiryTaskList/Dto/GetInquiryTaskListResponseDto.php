<?php

namespace App\Usecases\Inquiry\GetInquiryTaskList\Dto;

use App\Usecases\Inquiry\GetInquiryTaskList\Dto\InquiryTaskItemDto;

class GetInquiryTaskListResponseDto
{
    /**
     * @param InquiryTaskItemDto[] $data
     */
    public function __construct(
        public readonly array $data,
        public readonly int $totalCount
    ) {}
}
