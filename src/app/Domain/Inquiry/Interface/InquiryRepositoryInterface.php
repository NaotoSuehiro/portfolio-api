<?php

declare(strict_types=1);

namespace App\Domain\Inquiry\Interface;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\Entity\InquiryTask;
use App\Domain\Inquiry\Entity\InquiryComment;

interface InquiryRepositoryInterface
{
    public function createTask(InquiryTask $inquiryTask): void;

    public function updateTaskStatus(InquiryTask $inquiryTask): void;

    public function createComment(InquiryComment $inquiryTask): void;
}
