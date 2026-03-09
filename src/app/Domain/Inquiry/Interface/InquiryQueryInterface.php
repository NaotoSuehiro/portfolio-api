<?php

namespace App\Domain\Inquiry\Interface;

use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksResponseDto;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksRequestDto;

interface InquiryQueryInterface
{
    public function fetchInquiryTasks(GetInquiryTasksRequestDto $dto): GetInquiryTasksResponseDto;
}
