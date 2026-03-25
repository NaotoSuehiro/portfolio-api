<?php

namespace App\Usecases\Inquiry\GetInquiryTask\Dto;

use Illuminate\Support\Carbon;
use App\Usecases\Inquiry\GetInquiryTask\Dto\InquiryTaskCommentDto;

class InquiryTaskDetailDto
{
     /**
     * @param InquiryTaskCommentDto[] $comments
     */
    public function __construct(
        public readonly string $inquiryTaskId,
        public readonly string $title,
        public readonly string $content,
        public readonly string $status,
        public readonly Carbon $createdAt,
        public readonly array $comments
    ) {}
}
