<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramUserController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\DonasiController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProgramDonasiController;
use App\Http\Controllers\Admin\DonasiController as AdminDonasiController;

use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| USER / LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::view('/tentang', 'tentang')
    ->name('tentang');

Route::view('/kontak', 'kontak')
    ->name('kontak');

Route::get('/preferensi', function () {
    return view('preferensi');
});

Route::post('/preferensi', [PreferensiController::class, 'simpan']);

Route::post('/kontak/kirim', [KontakController::class, 'kirim'])
    ->name('kontak.kirim');

Route::post('/reset-kunjungan', function () {

    session()->forget([
        'kunjungan',
        'pertama',
        'terakhir',
    ]);

    return redirect()->back();

})->name('reset.kunjungan');


/*
|--------------------------------------------------------------------------
| PROGRAM DONASI (USER)
|--------------------------------------------------------------------------
*/

Route::get(
    '/donasi/{program}',
    [DonasiController::class, 'create']
)->name('donasi.create');

Route::post(
    '/donasi/{program}',
    [DonasiController::class, 'store']
)->name('donasi.store');

Route::get('/program-donasi', [ProgramUserController::class, 'index'])
    ->name('program-donasi.index');

Route::get('/program-donasi/{id}', [ProgramUserController::class, 'show'])
    ->name('program-donasi.show');

Route::get('/search-program', [ProgramUserController::class, 'search'])
    ->name('program-donasi.search');


/*
|--------------------------------------------------------------------------
| DONASI (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/donasi/{donasi}/pembayaran', [DonasiController::class, 'pembayaran'])
    ->name('donasi.pembayaran');

Route::post('/donasi/{donasi}/upload-bukti', [DonasiController::class, 'uploadBukti'])
    ->name('donasi.upload-bukti');


/*
|--------------------------------------------------------------------------
| PROFILE (JIKA MASIH DIPAKAI)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'cekadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/donasi', [AdminDonasiController::class, 'index'])
            ->name('donasi');

        Route::patch(
            '/donasi/{donasi}/verifikasi',
            [AdminDonasiController::class, 'verifikasi']
        )->name('donasi.verifikasi');

        Route::resource('program-donasi', ProgramDonasiController::class);

        Route::get(
            'program-donasi/{programDonasi}/detail',
            [ProgramDonasiController::class, 'detail']
        )->name('program-donasi.detail');

        Route::get(
            'program-donasi/{programDonasi}/edit-data',
            [ProgramDonasiController::class, 'editData']
        )->name('program-donasi.edit-data');

        Route::post(
            'program-donasi/{programDonasi}/ajax-update',
            [ProgramDonasiController::class, 'ajaxUpdate']
        )->name('program-donasi.ajax-update');

        Route::get(
            'program-donasi/search',
            [ProgramDonasiController::class, 'search']
        )->name('program-donasi.search');

    });

require __DIR__.'/auth.php';
