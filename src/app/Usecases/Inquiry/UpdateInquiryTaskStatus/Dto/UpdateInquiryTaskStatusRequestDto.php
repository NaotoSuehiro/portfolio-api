<?php

namespace App\Usecases\Inquiry\UpdateInquiryTaskStatus\Dto;

class UpdateInquiryTaskStatusRequestDto
{
    public function __construct(
        public readonly string $inquiryTaskId,
        public readonly string $status
    ) {}
}
