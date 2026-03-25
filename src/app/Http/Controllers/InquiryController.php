<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Inquiry\GetInquiryTaskListRequest;
use App\Http\Requests\Inquiry\GetInquiryTaskRequest;
use App\Http\Requests\Inquiry\GetInquiryRequest;
use App\Http\Requests\Inquiry\CreateInquiryTaskRequest;
use App\Http\Requests\Inquiry\UpdateInquiryTaskStatusRequest;
use App\Usecases\Inquiry\GetInquiryTaskList\GetInquiryTaskListUsecase;
use App\Usecases\Inquiry\GetInquiryTask\GetInquiryTaskUsecase;
use App\Usecases\Inquiry\CreateInquiryTask\CreateInquiryTaskUsecase;
use App\Usecases\Inquiry\UpdateInquiryTaskStatus\UpdateInquiryTaskStatusUsecase;


class InquiryController extends Controller
{

    public function __construct(
        private readonly GetInquiryTaskListUsecase $getInquiryTaskListUsecase,
        private readonly GetInquiryTaskUsecase  $getInquiryTaskUsecase,
        private readonly CreateInquiryTaskUsecase $createInquiryTaskUsecase,
        private readonly UpdateInquiryTaskStatusUsecase $updateInquiryTaskStatusUsecase,
    ) {}

    /**
     *  問い合わせ一覧情報を取得
     *  
     *  @response array{
     *    data: array<array{
     *      userId: string,
     *      title: string,
     *      content: string,
     *      status: string
     *    }>,
     *    totalCount: int
     *  }
     */
    public function index(GetInquiryTaskListRequest $request): object
    {
        $inquiries = $this->getInquiryTaskListUsecase->handle($request->toDto());
        return response()->json([$inquiries]);
    }

    /**
     * 問い合わせタスク詳細を取得
     *
     * @response array{
     *   data: array<array{
     *     inquiryTaskId: string,
     *     title: string,
     *     content: string,
     *     status: string,
     *     createdAt: string,
     *     comments: array<array{
     *       inquiryCommentId: string,
     *       userId: string,
     *       comment: string,
     *       createdAt: string
     *     }>
     *   }>
     * }
     */

    public function show(GetInquiryTaskRequest $request): object
    {
        $inquiries = $this->getInquiryTaskUsecase->handle($request->toDto());
        return response()->json([$inquiries]);
    }

    /**
     * 問い合わせ登録
     */
    public function store(CreateInquiryTaskRequest $request): object
    {
        $this->createInquiryTaskUsecase->handle($request->toDto());
        return response()->noContent();
    }

    /**
     * タスクのステータス更新
     */
    public function updateTaskStatus(UpdateInquiryTaskStatusRequest $request): object
    {
        $this->updateInquiryTaskStatusUsecase->handle($request->toDto());
        return response()->noContent();
    }
}
