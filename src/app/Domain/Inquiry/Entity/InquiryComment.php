<?php

namespace App\Domain\Inquiry\Entity;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\ValueObject\Comment;
use App\Domain\Inquiry\ValueObject\InquiryStatus;
use App\Domain\Common\Entity\EntityInterface;
use App\Domain\Common\Entity\EntityTrait;

class InquiryComment implements EntityInterface
{
    use EntityTrait;

    public function __construct(
        private UUId $id,
        private UUId $inquiryTaskId,
        private UUId $userId,
        private Comment $comment
    ) {}

    public function id(): UUId
    {
        return $this->id;
    }

    public function inquiryTaskId(): UUId
    {
        return $this->inquiryTaskId;
    }

    public function userId(): UUId
    {
        return $this->userId;
    }

    public function comment(): Comment
    {
        return $this->comment;
    }

    /*更新系**********************************************/
    public function updateComment(string $status): void
    {
        $this->comment = Comment::create($status);
    }
}
