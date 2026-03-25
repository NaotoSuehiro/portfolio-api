<?php

namespace App\Usecases\Inquiry\GetInquiryTask\Dto;

use App\Usecases\Inquiry\GetInquiryTask\Dto\InquiryTaskItemDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\InquiryTaskDetailDto;

class GetInquiryTaskResponseDto
{
    /**
     * @param InquiryTaskDetailDto[] $data
     */
    public function __construct(
        public readonly array $data
    ) {}
}
