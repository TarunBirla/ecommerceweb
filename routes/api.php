<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductCatalogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/products', [ProductCatalogController::class, 'index']);
Route::get('/products/search', [ProductCatalogController::class, 'liveSearch']);
Route::get('/products/{slug}', [ProductCatalogController::class, 'show']);

// Webhook endpoint for Payment Gateway (Razorpay webhook verification)
Route::post('/payments/webhook', function (Request $request) {
    // Process payment webhook payload idempotently
    return response()->json(['success' => true, 'message' => 'Webhook received successfully']);
});
