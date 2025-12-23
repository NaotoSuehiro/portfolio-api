<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// ユーザー
Route::prefix('users')->controller(UserController::class)->group(static function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/new', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});
