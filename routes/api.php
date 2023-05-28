<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserPostCommentController;
use App\Http\Controllers\API\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::resource('posts', PostController::class)->only(['index']);   

Route::resource('users.posts', UserPostController::class)->only(['index']);
Route::resource('users.comments', UserCommentController::class)->only(['index']);
Route::resource('posts.comments', PostCommentController::class)->only(['index']);
Route::resource('users.posts.comments', UserPostCommentController::class)->only(['index']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('posts', PostController::class)->only(['update', 'store', 'destroy']);

    Route::resource('comments', CommentController::class)->only(['update', 'store', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});