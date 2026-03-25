<?php

namespace App\Domain\Inquiry\Entity;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\ValueObject\Title;
use App\Domain\Inquiry\ValueObject\Content;
use App\Domain\Inquiry\ValueObject\InquiryStatus;
use App\Domain\Common\Entity\EntityInterface;
use App\Domain\Common\Entity\EntityTrait;

class InquiryTask implements EntityInterface
{
    use EntityTrait;

    public function __construct(
        private UUId $id,
        private Title $title,
        private Content $content,
        private InquiryStatus $status,
        private UUId $userId,
    ) {}

    public function id(): UUId
    {
        return $this->id;
    }

    public function title(): Title
    {
        return $this->title;
    }

    public function content(): Content
    {
        return $this->content;
    }

    public function status(): InquiryStatus
    {
        return $this->status;
    }

    public function userId(): UUId
    {
        return $this->userId;
    }

    /*更新系**********************************************/
    public function updateStatus(InquiryStatus $status): void
    {
        $this->status = $status;
    }
}
