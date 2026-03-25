<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Inquiry\GetInquiryTasksRequest;
use App\Http\Requests\Inquiry\GetInquiryTaskRequest;
use App\Http\Requests\Inquiry\GetInquiryRequest;
use App\Http\Requests\Inquiry\CreateInquiryTaskRequest;
use App\Usecases\Inquiry\GetInquiryTasks\GetInquiryTasksUsecase;
use App\Usecases\Inquiry\GetInquiryTask\GetInquiryTaskUsecase;
use App\Usecases\Inquiry\CreateInquiryTask\CreateInquiryTaskUsecase;


class InquiryController extends Controller
{

    public function __construct(
        private readonly GetInquiryTasksUsecase $getInquiryTasksUsecase,
        private readonly GetInquiryTaskUsecase  $getInquiryTaskUsecase,
        private readonly CreateInquiryTaskUsecase $createInquiryTaskUsecase,
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
    public function index(GetInquiryTasksRequest $request): object
    {
        $inquiries = $this->getInquiryTasksUsecase->handle($request->toDto());
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
}
