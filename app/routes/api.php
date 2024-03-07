<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AdminPanel\AdminController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Company\CompanyController;

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

Route::middleware('auth:api')->prefix('products')->group(function () {
    Route::post('/', [ProductController::class, 'create']);
    Route::put('/', [ProductController::class, 'update']);
    Route::delete('/', [ProductController::class, 'delete']);
    Route::get('/', [ProductController::class, 'getProduct']);
});

Route::middleware('auth:api')->prefix('companies')->group(function () {
    Route::post('/', [CompanyController::class, 'create']);
    Route::put('/', [CompanyController::class, 'update']);
    Route::get('/',[CompanyController::class,'getCompanyById']);
    Route::delete('/', [CompanyController::class, 'delete']);
});

Route::prefix('users')->group(function () {
    Route::post('/create', [UserController::class, 'create']);
    Route::middleware('auth:api')->group(function () {
        Route::put('/update', [UserController::class, 'update']);
        Route::delete('/delete', [UserController::class, 'delete']);
        Route::get('/user/{id}', [UserController::class, 'getUserById']);
    });
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->get('/admin', [AdminController::class,'getUsersWithRoleAndProducts']);

Route::get('/weather', [WeatherController::class, 'getCurrentWeather']);
