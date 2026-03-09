<?php

namespace App\Usecases\Inquiry\CreateInquiryTask\Dto;

class CreateInquiryTaskRequestDto
{
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly string $status,
        public readonly string $userId
    ) {}
}

