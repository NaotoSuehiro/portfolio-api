<?php

namespace App\Infrastructure\Postgres\Inquiry;

use App\Domain\Common\ValueObject\UUId;
use App\Models\InquiryTask as InquiryTaskModel;
use App\Models\InquiryComment as InquiryCommentModel;
use App\Domain\Inquiry\Entity\InquiryTask;
use App\Domain\Inquiry\Entity\InquiryComment;
use App\Domain\Inquiry\Interface\InquiryRepositoryInterface;
use App\Domain\Inquiry\Factory\InquiryFactory;
use App\Exceptions\DatabaseOperationException;
use Illuminate\Support\Facades\Log;

class InquiryPostgresRepository implements InquiryRepositoryInterface
{
    public function __construct(
        private readonly InquiryFactory $userFactory
    ) {}

    public function create(InquiryTask $inquiryTask):void
    {
        try {
            InquiryTaskModel::create([
                'inquiry_task_id' => $inquiryTask->id()->value(),
                'title' => $inquiryTask->title()->value(),
                'content' => $inquiryTask->content()->value(),
                'status' => $inquiryTask->status()->value(),
                'user_id' => $inquiryTask->userId()->value(),
            ]);
        } catch (\Exception $e) {
            throw new DatabaseOperationException('問い合わせの作成に失敗しました。');
        }
    }

    public function update(InquiryTask $inquiryTask): void
    {
        try {
            InquiryTaskModel::where('inquiry_task_id', $inquiryTask->id()->value())->update([
                'status' => $inquiryTask->status()->value(),
            ]);
        } catch (\Exception $e) {
            throw new DatabaseOperationException('ステータスの更新に失敗しました');
        }
    }

    public function createComment(InquiryComment $inquiryComment):void
    {
        try {
            InquiryCommentModel::create([
                'inquiry_comment_id' => $inquiryComment->id()->value(),
                'inquiry_task_id'    => $inquiryComment->inquiryTaskId()->value(),
                'user_id'            => $inquiryComment->userId()->value(),
                'comment'            => $inquiryComment->comment()->value()
            ]);
        } catch (\Exception $e) {
            throw new DatabaseOperationException('問い合わせの作成に失敗しました。');
        }
    }

    private function toDomainModel(InquiryModel $model): Inquiry
    {
        return $this->userFactory->reconstruct(
            inquiryTaskId: $model->getAttribute('inquiry_task_id'),
            title: $model->getAttribute('title'),
            content: $model->getAttribute('content'),
            status: $model->getAttribute('status'),
            userId: $model->getAttribute('user_id'),
        );
    }
}
