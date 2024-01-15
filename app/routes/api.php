<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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
    Route::post('/create', [UserController::class, 'create']);

    Route::middleware('auth:api')->group(function () {
        Route::put('/update', [UserController::class, 'updateUser']);
        Route::delete('/delete', [UserController::class, 'deleteUser']);
        Route::post('/switching', [UserController::class, 'toggleEnableStatus']);
        Route::get('/get', [UserController::class, 'getUser']);
    });
});
Route::post('/loginUser', [AuthController::class, 'login']);

Route::delete('/delete/{userId}', [ProductController::class, 'removeProductByUsingUserId']);
Route::post('/createProduct', [ProductController::class,'create']);

Route::middleware('auth:api')->get('/user', [UserController::class, 'getUser']);

Route::middleware('auth:api')->get('/product', [ProductController::class, 'getProductByUserId']);
Route::middleware('auth:api')->get('/productById', [ProductController::class, 'getProductById']);
Route::middleware('auth:api')->delete('/deleteProduct', [ProductController::class, 'deleteProduct']);
Route::middleware('auth:api')->put('/updateProduct', [ProductController::class, 'updateProduct']);
Route::middleware('auth:api')->put('/updateUser', [UserController::class, 'updateUser']);
Route::middleware('auth:api')->delete('/deleteUser', [UserController::class, 'deleteUser']);
Route::get('/product/{id}', [ProductController::class, 'getProductsById']);
Route::post('/create', [UserController::class, 'create']);
 Route::post('/login', [AuthController::class, 'login']);
