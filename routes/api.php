<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('bills',BillController::class);

Route::apiResource('products',ProductController::class);


Route::middleware([
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'auth:sanctum',
])->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/product-image/{filename}', [ProductController::class, 'serveImage']);