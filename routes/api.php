<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// routes/api.php
use App\Http\Controllers\Api\ServiceController as ApiServiceController;
use App\Http\Controllers\Api\GalleryController as ApiGalleryController;

Route::middleware('api')->prefix('v1')->group(function () {
    Route::get('services', [ApiServiceController::class, 'index']);
    Route::get('gallery', [ApiGalleryController::class, 'index']);
    Route::get('gallery/featured', [ApiGalleryController::class, 'featured']);
});
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
