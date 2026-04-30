<?php

namespace App\Domain\Inquiry\DomainService;

use App\Domain\Common\Interface\TransactionManagerInterface;
use App\Domain\Inquiry\Interface\InquiryRepositoryInterface;
use App\Domain\Inquiry\Entity\InquiryTask;
use App\Domain\Inquiry\Entity\InquiryComment;
use App\Exceptions\ValidationException;
use App\Domain\User\DomainService\UserService;
use App\Exceptions\ResourceNotFoundException;
use App\Domain\Inquiry\ValueObject\InquiryStatus;
use Illuminate\Support\Facades\DB;

class InquiryService
{
    public function __construct(
        private readonly InquiryRepositoryInterface $inquiryRepository,
        private readonly UserService $userService,
        private readonly TransactionManagerInterface $transactionManager
    ) {}

    /*ドメインルール
     -問い合わせ文言は基本更新不可で、何かあれば追加でメッセージを作成してもらう。（問い合わせの改ざんを防止のため）
     -問い合わせのタスクが完了になっていてもコメントが追加できたら再度ステータスをOPENにする（追加の問い合わせの取りこぼしがないようにするため）
    */
    public function createNewComment(InquiryComment $inquiryComment): void
    {

        //問い合わせ作成者を取得
        $this->userService->ensureUserExist($inquiryComment->userId());

        $inquiryTask = $this->inquiryRepository-> findByInquiryTaskId($inquiryComment->inquiryTaskId());

        if (!$inquiryTask) {
            throw new ResourceNotFoundException('タスクの取得に失敗しました');
        }

        $this->transactionManager->transaction(function () use ($inquiryComment, $inquiryTask) {
            //コメントの保存
            $this->inquiryRepository->createComment($inquiryComment);

            //問い合わせタスクのステータスが完了になっていたら、再度OPENにする
            if($inquiryTask->isStatusClosed()){
                $inquiryTask->reopenStatus();
                $this->inquiryRepository->updateTaskStatus($inquiryTask);
            }
        });
    }

}
