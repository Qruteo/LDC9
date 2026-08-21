<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/siswa', [AdminDashboardController::class, 'siswa'])
        ->name('admin.siswa');

    Route::get('/guru', [AdminDashboardController::class, 'guru'])
        ->name('admin.guru');

    Route::get('/kelas', [AdminDashboardController::class, 'kelas'])
        ->name('admin.kelas');

    Route::get('/mata-pelajaran', [AdminDashboardController::class, 'mataPelajaran'])
        ->name('admin.mata-pelajaran');

    Route::get('/jadwal', [AdminDashboardController::class, 'jadwal'])
        ->name('admin.jadwal');

    Route::get('/absensi', [AdminDashboardController::class, 'absensi'])
        ->name('admin.absensi');
});


/*
|--------------------------------------------------------------------------
| Profile
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


require __DIR__.'/auth.php';
Route::get('/admin/export', [\App\Http\Controllers\AdminExportController::class, 'export'])->middleware(['auth', 'role:admin'])->name('admin.export');
