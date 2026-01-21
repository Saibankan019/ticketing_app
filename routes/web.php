<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HistoriesController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\PaymentTypeController; // ✅ TAMBAHKAN INI
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\OrderController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [UserEventController::class, 'show'])->name('events.show');

// Auth Required Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // User Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Resource Routes
        Route::resource('categories', CategoryController::class);
        Route::resource('events', EventController::class);
        Route::resource('tickets', TiketController::class);
        Route::resource('payment-types', PaymentTypeController::class); // ✅ SUDAH BENAR

        // Custom Routes
        Route::get('/histories', [HistoriesController::class, 'index'])->name('histories.index');
        Route::get('/histories/{id}', [HistoriesController::class, 'show'])->name('histories.show');
    });
});

require __DIR__.'/auth.php';