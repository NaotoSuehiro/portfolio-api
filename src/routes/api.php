<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;

// ユーザー
Route::prefix('users')->controller(UserController::class)->group(static function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/new', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

//問い合わせ
Route::prefix('inquiries')->controller(InquiryController::class)->group(static function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/newTask', 'storeTask');
    Route::post('/newComment', 'storeComment');
});

