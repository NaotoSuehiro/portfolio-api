<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\Inquiry\GetInquiryTasksRequest;
use App\Http\Requests\Inquiry\GetInquiryRequest;
use App\Http\Requests\Inquiry\CreateInquiryTaskRequest;
use App\Usecases\Inquiry\GetInquiryTasks\GetInquiryTasksUsecase;
// use App\Usecases\Inquiry\GetInquiry\GetInquiryUsecase;
use App\Usecases\Inquiry\CreateInquiryTask\CreateInquiryTaskUsecase;


class InquiryController extends Controller
{

    public function __construct(
        private readonly GetInquiryTasksUsecase $getInquiryTasksUsecase,
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
     * 問い合わせ登録
     */
    public function storeTask(CreateInquiryTaskRequest $request): object
    {
        $this->createInquiryTaskUsecase->handle($request->toDto());
        return response()->noContent();
    }
}
