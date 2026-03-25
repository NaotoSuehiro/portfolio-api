<?php

declare(strict_types=1);

namespace App\Usecases\Inquiry\UpdateInquiryTaskStatus;


use App\Usecases\Inquiry\UpdateInquiryTaskStatus\Dto\UpdateInquiryTaskStatusRequestDto;
use App\Domain\Inquiry\Interface\InquiryRepositoryInterface;
use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\ValueObject\InquiryStatus;
use App\Exceptions\ResourceNotFoundException;

class UpdateInquiryTaskStatusUsecase
{
    public function __construct(
        private readonly InquiryRepositoryInterface $inquiryRepository
    ) {}

    public function handle(UpdateInquiryTaskStatusRequestDto $dto): void
    {

        //タスクを取得
        $inquiryTaskId = UUId::create($dto->inquiryTaskId);
        $inquiryTask =  $this->inquiryRepository->findByInquiryTaskId($inquiryTaskId);

        if(!$inquiryTask){
          throw new ResourceNotFoundException('問い合わせの取得に失敗しました。');
        }

        if($dto->status){
            $status = InquiryStatus::create($dto->status);
            $inquiryTask->updateStatus($status);
        }

        $this->inquiryRepository->updateTaskStatus($inquiryTask);
    }
}
