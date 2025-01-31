<?php

use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//
Route::get('/p/backup', [ProductsController::class, 'getProducts']);

Route::post('/upload-image', [ImageUploadController::class, 'upload']);
