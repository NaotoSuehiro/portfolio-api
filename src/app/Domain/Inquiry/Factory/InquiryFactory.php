<?php

namespace App\Domain\Inquiry\Factory;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\Entity\InquiryTask;
use App\Domain\Inquiry\Entity\InquiryComment;
use App\Domain\Inquiry\ValueObject\Title;
use App\Domain\Inquiry\ValueObject\Content;
use App\Domain\Inquiry\ValueObject\InquiryStatus;
use App\Domain\Inquiry\ValueObject\Comment;

class InquiryFactory
{
    public function createTask(
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

    public function createComment(
        string $inquiryTaskId,
        string $userId,
        string $comment
    ): InquiryComment 
    {
        return new InquiryComment(
            id: UUId::generate(),
            inquiryTaskId: UUId::create($inquiryTaskId),
            userId: UUId::create($userId),
            comment: Comment::create($comment),
        );
    }
}
