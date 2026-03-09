<?php

declare(strict_types=1);

namespace App\Domain\Inquiry\Interface;

use App\Domain\Common\ValueObject\UUId;
use App\Domain\Inquiry\Entity\InquiryTask;

interface InquiryRepositoryInterface
{
    public function create(InquiryTask $inquiryTask): void;

    public function update(InquiryTask $inquiryTask): void;
}
