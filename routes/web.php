<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherScanController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentAttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceExportController;

Route::get('/', function () {
    return view('welcome');
});


// =========================
// DASHBOARD UTAMA
// =========================

Route::get('/dashboard', function () {
    return redirect()->route('teacher.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/teacher/attendance', function () {
    return view('teacher.attendance');
})->middleware('auth')->name('teacher.attendance');

Route::get('/teacher/schedule', function () {
    return view('teacher.schedule');
})->middleware('auth')->name('teacher.schedule');

Route::get('/teacher/profile', function () {
    return view('teacher.profile');
})->middleware('auth')->name('teacher.profile');


// =========================
// AUTHENTICATED ROUTES
// =========================

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

    // =========================
    // TEACHER DASHBOARD
    // =========================

    Route::get('/teacher/dashboard', [
        TeacherDashboardController::class,
        'index'
    ])->name('teacher.dashboard');


    // =========================
    // CURRENT SESSION
    // =========================

    Route::get('/teacher/current', [
        TeacherDashboardController::class,
        'current'
    ])->name('teacher.current');


    // =========================
    // SESSION HISTORY
    // =========================

    Route::get('/teacher/sessions', [
        TeacherDashboardController::class,
        'sessions'
    ])->name('teacher.sessions');


    // =========================
    // SESSION DETAIL
    // =========================

    Route::get('/teacher/session', function () {

    $sessionId = request('session');

    $classSession = \App\Models\ClassSession::with([
        'schedule.classRoom.students',
        'schedule.subject',
        'teacher',
        'attendances'
    ])->findOrFail($sessionId);

    $students = $classSession->schedule->classRoom->students;

    return view('teacher.current-session', compact(
        'classSession',
        'students'
    ));

})->name('teacher.session');

    // =========================
    // QR SCANNER
    // =========================

    Route::get('/teacher/scan', [
        TeacherScanController::class,
        'scan'
    ])->name('teacher.scan');

    Route::post('/teacher/scan/validate', [
        TeacherScanController::class,
        'validateQr'
    ])->name('teacher.scan.validate');


    // =========================
    // PROFILE
    // =========================

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');


    // =========================
    // STUDENT
    // =========================

    Route::get('/student/dashboard', [
        StudentDashboardController::class,
        'index'
    ])->name('student.dashboard');

    Route::post('/student/attendance/{classSession}', [
        StudentAttendanceController::class,
        'store'
    ])->name('student.attendance.store');

    Route::get('/teacher/session/{classSession}/export', [
    AttendanceExportController::class,
    'export'
])->name('teacher.session.export');

    // Session History
    Route::get('/teacher/session-history', [
        \App\Http\Controllers\TeacherDashboardController::class,
        'sessions'
    ])->name('teacher.session-history');

});


require __DIR__.'/auth.php';

Route::get('/admin/export', [\App\Http\Controllers\AdminExportController::class, 'export'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.export');