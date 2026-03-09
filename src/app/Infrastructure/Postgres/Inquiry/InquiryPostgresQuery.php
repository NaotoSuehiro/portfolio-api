<?php

declare(strict_types=1);

namespace App\Infrastructure\Postgres\Inquiry;

use Illuminate\Database\Eloquent\Builder;
use App\Models\InquiryTask;
use App\Domain\Inquiry\Interface\InquiryQueryInterface;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\InquiryTaskItemDto;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksRequestDto;
use App\Usecases\Inquiry\GetInquiryTasks\Dto\GetInquiryTasksResponseDto;

class InquiryPostgresQuery implements InquiryQueryInterface
{

    public function fetchInquiryTasks(GetInquiryTasksRequestDto $dto): GetInquiryTasksResponseDto
    {
        $query = InquiryTask::query();

        // 検索条件を適用
        $this->applyFilters(
            query: $query,
            dto: $dto
        );

        // ソート順を適用
        $this->applySorting($query);

        $totalCount = $query->count();

        //ページネーション
        $inquiries = $query->offset(($dto->page - 1) * $dto->limit)
            ->limit($dto->limit)
            ->get();

        return new GetInquiryTasksResponseDto(
            totalCount: $totalCount,
            data: $inquiries->map(fn($inquiry) => $this->toListItemDto($inquiry))->all()
        );
    }

    private function applyFilters(Builder $query, GetInquiryTasksRequestDto  $dto): void
    {
        if (!empty($dto->title)) {
            $query->where(
                column: 'title',
                operator: 'like',
                value: '%' . $dto->title . '%'
            );
        }

        if (!empty($dto->content)) {
            $query->where(
                column: 'content',
                operator: 'like',
                value: '%' . $dto->content . '%'
            );
        }

        if (!empty($dto->status)) {
            $query->where(
                column: 'status',
                operator: '=',
                value: $dto->status
            );
        }

        if (!empty($dto->createdStartDate)) {
            $query->where(
                column: 'created_at',
                operator: '>=',
                value: $dto->createdStartDate
            );
        }

        if (!empty($dto->createdEndDate)) {
            $query->where(
                column: 'created_at',
                operator: '<=',
                value: $dto->createdEndDate
            );
        }
    }

    private function applySorting(Builder $query): void
    {
        $query->orderBy('created_at', 'DESC');
    }

    private function toListItemDto(InquiryTask $inquiry): InquiryTaskItemDto
    {

        return new InquiryTaskItemDto(
            inquiryId: $inquiry->getKey(),
            title: $inquiry->getAttribute('title'),
            content: $inquiry->getAttribute('content'),
            status: $inquiry->getAttribute('status'),
            createdAt: $inquiry->getAttribute('created_at')
        );
    }
}
