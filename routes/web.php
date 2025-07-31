<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RepairJobController;

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

    Route::resource('vehicles', VehicleController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('repair-jobs', RepairJobController::class);
    Route::resource('printed-jobs', PrintedJobController::class);
    
    Route::get('/repair-jobs/{id}/print', [RepairJobController::class, 'print'])->name('repair-jobs.print');
    Route::get('/printed', [RepairJobController::class, 'printedInvoices'])->name('repair-jobs.printed');
    Route::post('/repair-jobs/{id}/mark-printed', [RepairJobController::class, 'markAsPrinted'])->name('repair-jobs.markPrinted');

});

require __DIR__.'/auth.php';
