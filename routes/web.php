<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IncomingItemController;
use App\Http\Controllers\OutgoingItemController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource Routes
    Route::resource('products', ProductController::class);
    Route::resource('incoming-items', IncomingItemController::class);
    Route::resource('outgoing-items', OutgoingItemController::class);

    // Reports
    Route::get('/reports/incoming', [ReportController::class, 'incoming'])->name('reports.incoming');
    Route::get('/reports/outgoing', [ReportController::class, 'outgoing'])->name('reports.outgoing');
});

require __DIR__.'/auth.php';
