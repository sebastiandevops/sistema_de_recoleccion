<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\CollectionController;

Route::middleware('auth')->group(function () {
    Route::resource('collections', CollectionController::class);
    // Cancel a scheduled collection
    Route::patch('collections/{collection}/cancel', [\App\Http\Controllers\CollectionController::class, 'cancel'])->name('collections.cancel');
    // Reports
    Route::get('reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::post('reports', [\App\Http\Controllers\ReportController::class, 'store'])->name('reports.store');
    Route::get('reports/download/{filename}', [\App\Http\Controllers\ReportController::class, 'download'])->name('reports.download');
    Route::delete('reports/{filename}', [\App\Http\Controllers\ReportController::class, 'destroy'])->name('reports.destroy');
});
