<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return view('admin.dashboard'); // admin dashboard
        }
        return view('dashboard'); // user dashboard
    })->name('dashboard');

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/users', function () {
            return "Only admin can access this page";
        })->name('admin.users');
    });
});

require __DIR__.'/auth.php';
