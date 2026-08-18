<?php

use App\Models\ClassRoom;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherScanController;
use App\Http\Controllers\TeacherDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('teacher.dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // =========================
    // TEACHER DASHBOARD
    // =========================

    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])
        ->name('teacher.dashboard');


    // =========================
    // QR SCANNER
    // =========================

    Route::get('/teacher/scan', [TeacherScanController::class, 'scan'])
        ->name('teacher.scan');

    Route::post('/teacher/scan/validate', [TeacherScanController::class, 'validateQr'])
        ->name('teacher.scan.validate');


    // =========================
    // TEACHER SESSION
    // =========================

    Route::get('/teacher/session', function () {

        $sessionId = request('session');

        $classSession = \App\Models\ClassSession::with([
    'schedule.classRoom.students',
    'schedule.subject',
    'teacher'
])->findOrFail($sessionId);

$students = $classSession->schedule->classRoom->students;

       return view('teacher.session', compact('classSession', 'students'));

    })->name('teacher.session');


    // =========================
    // PROFILE
    // =========================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

        Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->name('student.dashboard');
});


require __DIR__.'/auth.php';