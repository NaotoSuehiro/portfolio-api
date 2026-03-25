<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Http\Requests\InquiryComment\CreateInquiryCommentRequest;
use App\Usecases\InquiryComment\CreateInquiryComment\CreateInquiryCommentUsecase;


class InquiryCommentController extends Controller
{

    public function __construct(
        private readonly CreateInquiryCommentUsecase $createInquiryCommentUsecase,
    ) {}

    /**
     * 問い合わせ登録
     */
    public function store(CreateInquiryCommentRequest $request): object
    {
        $this->createInquiryCommentUsecase->handle($request->toDto());
        return response()->noContent();
    }
}
