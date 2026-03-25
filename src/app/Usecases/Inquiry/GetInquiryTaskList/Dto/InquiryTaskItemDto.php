<?php

namespace App\Usecases\Inquiry\GetInquiryTaskList\Dto;
use Illuminate\Support\Carbon;

class InquiryTaskItemDto
{
    public function __construct(
        public readonly string $inquiryTaskId,
        public readonly string $title,
        public readonly string $content,
        public readonly string $status,
        public readonly Carbon $createdAt,
    ) {}
}
