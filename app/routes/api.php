<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use \App\Http\Controllers\AdminPanel\AdminController;

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

Route::prefix('products')->group(function () {
    Route::post('/create', [ProductController::class, 'create']);

    Route::middleware('auth:api')->group(function () {
        Route::put('/update/{id}', [ProductController::class, 'updateProduct']);
        Route::delete('/delete', [ProductController::class, 'deleteProduct']);
        Route::get('/product', [ProductController::class, 'getProductByUserId']);
    });
});
Route::prefix('users')->group(function () {
    Route::post('/create', [UserController::class, 'create']);

    Route::middleware('auth:api')->group(function () {
        Route::put('/update', [UserController::class, 'updateUser']);
        Route::delete('/delete', [UserController::class, 'deleteUser']);
        Route::post('/switching', [UserController::class, 'toggleEnableStatus']);
        Route::get('/get', [UserController::class, 'getUser']);
    });
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/admin',[AdminController::class,'getUsersWithRoleAndProducts']);
