<?php

use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactMessageController;
use App\Http\Controllers\Api\HeroController;
use App\Http\Controllers\Api\OfferController;

// Content endpoints (GET)
Route::get('/about', [AboutController::class, 'apiIndex']);
Route::get('/promotion', [PromotionController::class, 'apiIndex']);
Route::get('/reviews', [ReviewController::class, 'apiIndex']);
Route::get('/contact-info', [ContactController::class, 'apiIndex']);
Route::get('/hero', [HeroController::class, 'apiIndex']);
Route::get('/offers', [OfferController::class, 'apiIndex']);

// Form submission endpoint (POST)
Route::post('/contact-message', [ContactMessageController::class, 'store']);

// Admin routes (protected - you'll add middleware later)
Route::prefix('admin')->group(function () {
    // Hero management
    Route::apiResource('hero', HeroController::class)->except(['index']);
    
    // About management
    Route::apiResource('about', AboutController::class)->except(['index']);
    
    // Promotion management
    Route::apiResource('promotion', PromotionController::class)->except(['index']);
    
    // Review management
    Route::apiResource('reviews', ReviewController::class)->except(['index']);
    
    // Contact management
    Route::apiResource('contact', ContactController::class)->except(['index']);
    
    // Contact messages management
    Route::apiResource('contact-messages', ContactMessageController::class);
    Route::get('/contact-messages/pending/count', [ContactMessageController::class, 'pendingCount']);

    // Offer management
    Route::apiResource('offers', OfferController::class)->except(['index', 'show']);
});

