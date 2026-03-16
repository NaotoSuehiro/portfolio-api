<?php

namespace App\Domain\Inquiry\Factory;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\Entity\InquiryTask;
use App\Domain\Inquiry\ValueObject\Title;
use App\Domain\Inquiry\ValueObject\Content;
use App\Domain\Inquiry\ValueObject\InquiryStatus;

class InquiryFactory
{
    public function create(
        string $title,
        string $content,
        string $status,
        string $userId
    ): InquiryTask 
    {
        return new InquiryTask(
            id: UUId::generate(),
            title: Title::create($title),
            content: Content::create($content),
            status: InquiryStatus::create($status),
            userId: UUId::create($userId)
        );
    }
}
