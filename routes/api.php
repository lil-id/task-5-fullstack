<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;

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

Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::get('posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('posts/{id}', [PostsController::class, 'detail'])->name('posts.detail');
    Route::post('posts', [PostsController::class, 'create'])->name('posts.create');
    Route::post('posts/{id}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('posts/{id}', [PostsController::class, 'delete'])->name('posts.delete'); 
});