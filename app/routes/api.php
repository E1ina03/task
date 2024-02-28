<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\IndexUserController;
use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\UpdateUserController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\AdminPanel\AdminController;
use App\Http\Controllers\Product\ReadProductController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\UpdateProductController;
use App\Http\Controllers\Product\DeleteProductController;


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
    Route::middleware('auth:api')->group(function () {
        Route::post('/create', [CreateProductController::class, 'create']);
        Route::put('/update', [UpdateProductController::class, 'update']);
        Route::delete('/delete', [DeleteProductController::class, 'delete']);
        Route::get('/read', [ReadProductController::class, 'read']);
    });
});
Route::prefix('users')->group(function () {
    Route::post('/create', [CreateUserController::class, 'create']);
    Route::middleware('auth:api')->group(function () {
        Route::put('/update', [UpdateUserController::class, 'update']);
        Route::delete('/delete', [DeleteUserController::class, 'delete']);
        Route::get('/index', [IndexUserController::class, 'index']);
    });
});



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/admin', [AdminController::class,'getUsersWithRoleAndProducts']);

Route::get('/weather', [WeatherController::class, 'getCurrentWeather']);
