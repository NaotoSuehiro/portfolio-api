<?php

namespace App\Usecases\Inquiry\GetInquiryTasks\Dto;
use Illuminate\Support\Carbon;

class InquiryTaskItemDto
{
    public function __construct(
        public readonly string $inquiryId,
        public readonly string $title,
        public readonly string $content,
        public readonly string $status,
        public readonly Carbon $createdAt,
    ) {}
}
