<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramDonasiController;
use App\Http\Controllers\ProfileController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::view('/tentang', 'tentang')
    ->name('tentang');

Route::view('/kontak', 'kontak')
    ->name('kontak');


Route::middleware('auth')->group(function () {

    Route::resource(
        'program-donasi',
        ProgramDonasiController::class
    );

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware(['auth', 'cekadmin'])->group(function () {
    Route::resource(
        'program-donasi',
        ProgramDonasiController::class
    );
});


require __DIR__.'/auth.php';
