<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


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
    Route::post('/createProduct', [ProductController::class, 'create']);

    Route::middleware('auth:api')->group(function () {
        Route::put('/updateProduct', [ProductController::class, 'updateProduct']);
        Route::delete('/deleteProduct', [ProductController::class, 'deleteProduct']);
        Route::get('/product', [ProductController::class, 'getProductById']);
        Route::get('/userOwnedProducts', [ProductController::class, 'getProductByUserId']);
    });
});
Route::prefix('users')->group(function () {
    Route::post('/createUser', [UserController::class, 'create']);

    Route::middleware('auth:api')->group(function () {
        Route::put('/updateUser', [UserController::class, 'updateUser']);
        Route::delete('/deleteUser', [UserController::class, 'deleteUser']);
        Route::post('/switchingUserCapabilities', [UserController::class, 'toggleEnableStatus']);
        Route::get('/user', [UserController::class, 'getUser']);
    });
});
Route::post('/loginUser', [OutController::class, 'login']);

