<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceOrderController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Semua butuh login
Route::middleware(['auth'])->group(function () {

    // Dashboard pakai controller (AdminLTE)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        // kalau lu tetep mau pakai verified:
        // ->middleware('verified')
        ->name('dashboard');

    // Hanya admin yang boleh kelola services
    Route::middleware('role:admin')->group(function () {
        Route::resource('services', ServicesController::class);
    });

    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('customers', CustomersController::class);
        Route::resource('orders', ServiceOrderController::class);
    });

    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
