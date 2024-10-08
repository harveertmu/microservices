<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductDetailController;


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

Route::group(['prefix' => '/auth'], function () {
    Route::post('/register', [AuthController::class, 'createUser']);
    Route::post('/login', [AuthController::class, 'loginUser']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum']) // Use your middleware name here
    ->prefix('/auth') // Define the prefix
    ->group(function () {
        Route::get('/products', [ProductController::class, 'index']); // Retrieve a all user
        Route::post('/product', [ProductController::class, 'store']);// insert  a user
        Route::get('/product/{id}', [ProductController::class, 'show']); // Retrieve a single user
        Route::put('/product/{id}', [ProductController::class, 'update']); // Update the entire user
        Route::patch('/product/{id}', [ProductController::class, 'patchUpdate']); // Partially update the user
        Route::delete('/product/{id}', [ProductController::class, 'destroy']); // Delete a user


        Route::post('/product-details', [ProductDetailController::class, 'store']);

    });