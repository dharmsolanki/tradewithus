<?php

use App\Http\Controllers\InvestmentDetailsController;
use App\Http\Controllers\ProfileController;
use App\Models\InvestmentDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard route (shared, role-based view)
    Route::get('/dashboard', function () {

        if (auth()->user()->isAdmin()) {
            return view('admin.dashboard'); // admin dashboard
        }
        return view('dashboard'); // user dashboard
    })->name('dashboard');

    // Profile routes (for all authenticated users)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route to show the investment form (for all authenticated users)
    Route::get('dashboard/invest', [InvestmentDetailsController::class, 'index'])->name('investment.index');
    Route::get('dashboard/add-investment', [InvestmentDetailsController::class, 'showForm'])->name('show-form');
    Route::post('dashboard/add-investment', [InvestmentDetailsController::class, 'store'])->name('investment.store');

    // Admin-only routes
    Route::middleware('admin')->group(function () {

        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::get('/dashboard/users', function () {
            return view('admin.users', ['users' => \App\Models\User::all()]);
        })->name('admin.users');

        Route::patch('/dashboard/investment/{id}/status', [InvestmentDetailsController::class, 'updateStatus'])
            ->name('investment.updateStatus'); // Only admin can change status

        // You can add more admin routes here
    });
});

require __DIR__ . '/auth.php';
