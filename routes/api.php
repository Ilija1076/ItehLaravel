<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileArticleController;
use App\Http\Controllers\ProfileCommentController;
use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ProfileArticleCommentController;
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

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
    return $request->profile();
});

Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::resource('articles', ArticleController::class)->only(['index']);   

Route::resource('profiles.articles', ProfileArticleController::class)->only(['index']);
Route::resource('profiles.comments', ProfileCommentController::class)->only(['index']);
Route::resource('articles.comments', ArticleCommentController::class)->only(['index']);
Route::resource('profiles.articles.comments', ProfileArticleCommentController::class)->only(['index']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->profile();
    });

    Route::resource('articles', ArticleController::class)->only(['update', 'store', 'destroy']);

    Route::resource('comments', CommentController::class)->only(['update', 'store', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});