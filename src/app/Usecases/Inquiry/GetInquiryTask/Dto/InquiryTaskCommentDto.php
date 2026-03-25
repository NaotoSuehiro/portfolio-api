<?php

namespace App\Usecases\Inquiry\GetInquiryTask\Dto;
use Illuminate\Support\Carbon;

class InquiryTaskCommentDto
{
    public function __construct(
        public readonly string $inquiryCommentId,
        public readonly string $userId,
        public readonly string $comment,
        public readonly Carbon $createdAt,
    ) {}
}
