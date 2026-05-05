<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Redirect root ke dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Halaman statis
Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/kontak', 'kontak')->name('kontak');

// Contoh route lain
Route::get('/hitung/{a}/{b}', fn($a, $b) => $a + $b);
