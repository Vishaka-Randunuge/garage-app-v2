<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RepairJobController;
use App\Http\Controllers\PrintedJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resources
    Route::resource('vehicles', VehicleController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('repair-jobs', RepairJobController::class);
    Route::resource('printed-jobs', PrintedJobController::class);

    // Repair job extra routes
    Route::get('/repair-jobs/{id}/print', [RepairJobController::class, 'print'])->name('repair-jobs.print');
    Route::get('/printed', [RepairJobController::class, 'printedInvoices'])->name('repair-jobs.printed');
    Route::post('/repair-jobs/{id}/mark-printed', [RepairJobController::class, 'markAsPrinted'])->name('repair-jobs.markPrinted');
});

// Admin-only routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Add your future user management here
    // Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
