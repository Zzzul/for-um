<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,PostController,UserController,ReplyController,CommentController,VoteController,SettingController};

Auth::routes();

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::resource('post', PostController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('comment', CommentController::class)
        ->except('create', 'show');

    Route::resource('reply', ReplyController::class)
        ->except('create', 'show');

    Route::get('/notification', [UserController::class, 'notification'])
        ->name('notification');

    Route::get('/notification/{id}/{slug}', [UserController::class, 'markAsReadNotification'])
        ->name('notification.markAsRead');

    Route::resource('vote', VoteController::class)
        ->only('store');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/change-profile', [SettingController::class, 'ChangeProfile'])->name('setting.ChangeProfile');
    Route::put('/change-password', [SettingController::class, 'ChangePassword'])->name('setting.ChangePassword');
});
