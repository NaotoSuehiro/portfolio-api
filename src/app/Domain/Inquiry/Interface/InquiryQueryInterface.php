<?php

namespace App\Domain\Inquiry\Interface;

use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksResponseDto;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksRequestDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskResponseDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskRequestDto;


interface InquiryQueryInterface
{
    public function fetchInquiryTasks(GetInquiryTasksRequestDto $dto): GetInquiryTasksResponseDto;

    public function fetchInquiryTaskDetail(GetInquiryTaskRequestDto $dto):GetInquiryTaskResponseDto;

}
