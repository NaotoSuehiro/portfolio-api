<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\InquiryCommentController;

// ユーザー
Route::prefix('users')->controller(UserController::class)->group(static function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/new', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::prefix('inquiries')->group(function () {
    //問い合わせタスク
    Route::get('/', [InquiryController::class, 'index']);
    Route::get('/{inquiryTaskId}', [InquiryController::class, 'show']);
    Route::post('/new', [InquiryController::class, 'store']);

    //問い合わせコメント
    Route::post('/{inquiryTaskId}/comments', [InquiryCommentController::class, 'store']);
});

