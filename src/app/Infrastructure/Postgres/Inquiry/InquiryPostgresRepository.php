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
        private readonly InquiryFactory $inquiryFactory
    ) {}

    public function findByInquiryTaskId(UUId $id): ?InquiryTask
    {
        $model = InquiryTaskModel::find($id->value());
        return $model ? $this->toDomainModel($model) : null;
    }

    public function createTask(InquiryTask $inquiryTask):void
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

    public function updateTaskStatus(InquiryTask $inquiryTask): void
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

    private function toDomainModel(InquiryTaskModel $model): InquiryTask
    {
        return $this->inquiryFactory->reconstructTask(
            id: $model->getkey(),
            title: $model->getAttribute('title'),
            content: $model->getAttribute('content'),
            status: $model->getAttribute('status'),
            userId: $model->getAttribute('user_id')
        );
    }
}
