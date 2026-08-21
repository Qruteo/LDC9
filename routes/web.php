<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherScanController;
use App\Http\Controllers\TeacherDashboardController;
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

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/teacher/dashboard', [
        \App\Http\Controllers\TeacherDashboardController::class,
        'index'
    ])->name('teacher.dashboard');


    // Scan Class QR
    Route::get('/teacher/scan', [
        \App\Http\Controllers\TeacherScanController::class,
        'scan'
    ])->name('teacher.scan');


    // My Sessions
    Route::get('/teacher/sessions', [
        \App\Http\Controllers\TeacherDashboardController::class,
        'sessions'
    ])->name('teacher.sessions');


    // My Attendance
    Route::get('/teacher/attendance', function () {
        return view('teacher.attendance');
    })->name('teacher.attendance');


    // Schedule
    Route::get('/teacher/schedule', function () {
        return view('teacher.schedule');
    })->name('teacher.schedule');


    // Session History
    Route::get('/teacher/session-history', function () {
        return view('teacher.session-history');
    })->name('teacher.session-history');


    // Profile
    Route::get('/teacher/profile', function () {
        return view('teacher.profile');
    })->name('teacher.profile');

});

});


require __DIR__.'/auth.php';