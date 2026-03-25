<?php

namespace App\Domain\Inquiry\Interface;

use App\Usecases\Inquiry\GetInquiryTaskList\Dto\GetInquiryTaskListResponseDto;
use App\Usecases\Inquiry\GetInquiryTaskList\Dto\GetInquiryTaskListRequestDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskResponseDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskRequestDto;


interface InquiryQueryInterface
{
    public function fetchInquiryTaskList(GetInquiryTaskListRequestDto $dto): GetInquiryTaskListResponseDto;

    public function fetchInquiryTaskDetail(GetInquiryTaskRequestDto $dto):GetInquiryTaskResponseDto;

}
