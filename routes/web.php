<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
