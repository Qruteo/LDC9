<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/admin/qr-scanning', function () {
    return view('admin.qr-scanning.index');
})->middleware('auth')->name('admin.qr-scanning');

Route::get('/admin/sesi', function () {
    return view('admin.sesi.index');
})->middleware('auth')->name('admin.sesi');

Route::get('/admin/riwayat', function () {
    return view('admin.riwayat.index');
})->middleware('auth')->name('admin.riwayat');

Route::get('/admin/export-data', function () {
    return view('admin.export-data.index');
})->middleware('auth')->name('admin.export-data');

Route::get('/admin/riwayat-siswa', function () {
    return view('admin.riwayat-siswa.index');
})->middleware('auth')->name('admin.riwayat-siswa');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
