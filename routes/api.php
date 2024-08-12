<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

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
Route::resource('/product', ProductController::class);

Route::resource('/category', CategoryController::class);
Route::resource('/brand', BrandController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product{id}', [ProductController::class, 'update']);
    Route::delete('/product{id}', [ProductController::class, 'destroy']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category{id}', [CategoryController::class, 'update']);
    Route::delete('/category{id}', [CategoryController::class, 'destroy']);
    Route::post('/brand', [BrandController::class, 'store']);
    Route::put('/brand{id}', [BrandController::class, 'update']);
    Route::delete('/brand{id}', [BrandController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});