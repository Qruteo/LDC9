<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherSessionController;
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


/*
|--------------------------------------------------------------------------
| Teacher
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:guru'])->prefix('teacher')->group(function () {

    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])
        ->name('teacher.dashboard');

    Route::get('/current', [TeacherDashboardController::class, 'current'])
        ->name('teacher.current');

    Route::get('/sessions', [TeacherDashboardController::class, 'sessions'])
        ->name('teacher.sessions');

        Route::get('/scan', function () {
        return view('teacher.scan');
    })->name('teacher.scan');

        Route::post('/scan/validate', [TeacherSessionController::class, 'scan'])
->name('teacher.scan.validate');

        Route::post('/session/{schedule}/start', [TeacherSessionController::class, 'start'])
    ->name('teacher.session.start');

    Route::post('/session/{classSession}/finish', [TeacherSessionController::class, 'finish'])
        ->name('teacher.session.finish');

        Route::post('/session/{classSession}/attendance', [TeacherSessionController::class, 'attendance'])
    ->name('teacher.session.attendance');

    // TAMBAHKAN INI
    Route::get('/session', function () {
        $sessionId = request('session');

        $classSession = \App\Models\ClassSession::with([
            'schedule.classRoom.students',
            'schedule.subject',
            'teacher',
            'attendances',
        ])->findOrFail($sessionId);

        $students = $classSession->schedule->classRoom->students;

        return view('teacher.current-session', compact(
            'classSession',
            'students'
        ));
    })->name('teacher.session');
});


require __DIR__.'/auth.php';

Route::get('/admin/export', [\App\Http\Controllers\AdminExportController::class, 'export'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.export');