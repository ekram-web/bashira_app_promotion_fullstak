<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\HeroController as AdminHeroController;
use App\Http\Controllers\Api\AboutController as AdminAboutController;
use App\Http\Controllers\Api\PromotionController as AdminPromotionController;
use App\Http\Controllers\Api\ReviewController as AdminReviewController;
use App\Http\Controllers\Api\ContactController as AdminContactController;
use App\Http\Controllers\Api\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Api\OfferController as AdminOfferController;




// Admin routes (protected with auth middleware)
Route::prefix('admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Hero management
    Route::resource('hero', AdminHeroController::class);
    
    // About management
    Route::resource('about', AdminAboutController::class);
    
    // Promotion management
    Route::resource('promotion', AdminPromotionController::class);
    
    // Review management
    Route::resource('reviews', AdminReviewController::class);
    
    // Contact management
    Route::resource('contact', AdminContactController::class);
    
    // Contact messages management
    Route::resource('contact-messages', AdminContactMessageController::class);
    Route::get('contact-messages/pending/count', [AdminContactMessageController::class, 'pendingCount'])->name('contact-messages.pending-count');
    Route::patch('contact-messages/{id}/toggle-read', [AdminContactMessageController::class, 'toggleRead'])->name('contact-messages.toggle-read');
    
    // Offer management
    Route::resource('offers', AdminOfferController::class);
   
});

// Authentication routes (if using Laravel Breeze)
require __DIR__.'/auth.php';

// Route::get('/clear-notification', function () {
//     session()->forget('persistent_success');
//     return response()->json(['status' => 'cleared']);
// });

// Route::get('/clear-error', function () {
//     session()->forget('persistent_error');
//     return response()->json(['status' => 'cleared']);
// });

// Route::get('/admin/test-persistent-success', function () {
//     session(['persistent_success' => 'Persistent success works!']);
//     return redirect('/admin/about');
// });
// Route::get('/admin/test-persistent-error', function () {
//     session(['persistent_error' => 'Persistent error works!']);
//     return redirect('/admin/about');
// });

