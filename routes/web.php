<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;

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

Route::resource('comment', CommentController::class);

Route::resource('reply', ReplyController::class)->middleware('auth');

Route::get('/notification', [UserController::class, 'notification'])
    ->name('notification')->middleware('auth');

Route::get('/notification/{id}/{slug}', [UserController::class, 'markAsReadNotification'])
    ->name('notification.markAsRead')->middleware('auth');
