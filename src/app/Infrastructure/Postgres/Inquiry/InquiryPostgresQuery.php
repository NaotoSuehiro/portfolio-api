<?php

declare(strict_types=1);

namespace App\Infrastructure\Postgres\Inquiry;

use Illuminate\Database\Eloquent\Builder;
use App\Models\InquiryTask;
use App\Models\InquiryComment;
use App\Domain\Inquiry\Interface\InquiryQueryInterface;
use App\Usecases\Inquiry\GetInquiryTaskList\Dto\InquiryTaskItemDto;
use App\Usecases\Inquiry\GetInquiryTaskList\Dto\GetInquiryTaskListRequestDto;
use App\Usecases\Inquiry\GetInquiryTaskList\Dto\GetInquiryTaskListResponseDto;

use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskResponseDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\GetInquiryTaskRequestDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\InquiryTaskDetailDto;
use App\Usecases\Inquiry\GetInquiryTask\Dto\InquiryTaskCommentDto;

class InquiryPostgresQuery implements InquiryQueryInterface
{

    public function fetchInquiryTaskList(GetInquiryTaskListRequestDto $dto): GetInquiryTaskListResponseDto
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

        return new GetInquiryTaskListResponseDto(
            totalCount: $totalCount,
            data: $inquiries->map(fn($inquiry) => $this->toListItemDto($inquiry))->all()
        );
    }

    private function applyFilters(Builder $query, GetInquiryTaskListRequestDto  $dto): void
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
            inquiryTaskId: $inquiry->getKey(),
            title: $inquiry->getAttribute('title'),
            content: $inquiry->getAttribute('content'),
            status: $inquiry->getAttribute('status'),
            createdAt: $inquiry->getAttribute('created_at')
        );
    }

    /*タスク詳細を取得*/
    public function fetchInquiryTaskDetail(GetInquiryTaskRequestDto $dto):GetInquiryTaskResponseDto
    {

       $inquiries = InquiryTask::with('inquiryComments')->where('inquiry_task_id', $dto->inquiryTaskId)->get();

        return new GetInquiryTaskResponseDto(
            data: $inquiries->map(fn($inquiry) => $this->toTaskDetailDto($inquiry))->all()
        );
    }

    private function toTaskDetailDto(InquiryTask $inquiry): InquiryTaskDetailDto
    {
        return new InquiryTaskDetailDto(
            inquiryTaskId: $inquiry->getKey(),
            title: $inquiry->getAttribute('title'),
            content: $inquiry->getAttribute('content'),
            status: $inquiry->getAttribute('status'),
            createdAt: $inquiry->getAttribute('created_at'),
            comments: $inquiry->inquiryComments
                ->map(fn($comment) => $this->toCommentDto($comment))
                ->all()
        );
    }

    private function toCommentDto(InquiryComment $comment): InquiryTaskCommentDto
    {
        return new InquiryTaskCommentDto(
            inquiryCommentId: $comment->getAttribute('inquiry_comment_id'),
            userId: $comment->getAttribute('user_id'),
            comment: $comment->getAttribute('comment'),
            createdAt: $comment->getAttribute('created_at')
        );
    } 
}
