<?php

namespace App\Usecases\Inquiry\GetInquiryTasks\Dto;

class GetInquiryTasksRequestDto
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $content,
        public readonly ?string $status,
        public readonly ?string $createdStartDate,
        public readonly ?string $createdEndDate,
        public readonly int $limit,
        public readonly int $page,
    ) {}
}
