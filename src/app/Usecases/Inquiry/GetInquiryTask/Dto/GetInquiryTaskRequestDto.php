<?php

namespace App\Usecases\Inquiry\GetInquiryTask\Dto;

class GetInquiryTaskRequestDto
{
    public function __construct(
      public readonly string $inquiryTaskId
    ) {}
}
