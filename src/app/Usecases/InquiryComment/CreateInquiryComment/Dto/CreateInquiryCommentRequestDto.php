<?php

namespace App\Usecases\InquiryComment\CreateInquiryComment\Dto;

class CreateInquiryCommentRequestDto
{
    public function __construct(
        public readonly string $inquiryTaskId,
         public readonly string $userId,
        public readonly string $comment,
    ) {}
}

