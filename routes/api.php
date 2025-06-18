<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->name('auth.')->group(function () {

    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    });
});

Route::prefix('posts')->middleware('auth:api')->group(function () {
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::patch('{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/{post:slug}', [PostController::class, 'show']);
});
Route::middleware('auth:api')->group(function () {
    Route::post('posts/{post:slug}/comments', [CommentController::class, 'store']);
    Route::get('posts/{post:slug}/comments', [CommentController::class, 'index']);
    Route::patch('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
});
