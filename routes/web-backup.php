<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminExportController;
use App\Http\Controllers\AttendanceExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherScanController;


/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Dashboard Utama
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $role = auth()->user()->role ?? null;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        default => redirect()->route('teacher.dashboard'),
    };

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('admin.dashboard');


        // Data Siswa
        Route::get('/siswa', [
            AdminDashboardController::class,
            'siswa'
        ])->name('admin.siswa');


        // Data Guru
        Route::get('/guru', [
            AdminDashboardController::class,
            'guru'
        ])->name('admin.guru');


        // Data Kelas
        Route::get('/kelas', [
            AdminDashboardController::class,
            'kelas'
        ])->name('admin.kelas');


        // Mata Pelajaran
        Route::get('/mata-pelajaran', [
            AdminDashboardController::class,
            'mataPelajaran'
        ])->name('admin.mata-pelajaran');


        // Jadwal
        Route::get('/jadwal', [
            AdminDashboardController::class,
            'jadwal'
        ])->name('admin.jadwal');


        // Absensi
        Route::get('/absensi', [
            AdminDashboardController::class,
            'absensi'
        ])->name('admin.absensi');


        // QR Scanning
        Route::get('/qr-scanning', function () {
            return view('admin.qr-scanning.index');
        })->name('admin.qr-scanning');


        // Sesi
        Route::get('/sesi', function () {
            return view('admin.sesi.index');
        })->name('admin.sesi');


        // Riwayat
        Route::get('/riwayat', function () {
            return view('admin.riwayat.index');
        })->name('admin.riwayat');


        // Export Data
        Route::get('/export-data', function () {
            return view('admin.export-data.index');
        })->name('admin.export-data');


        // Riwayat Siswa
        Route::get('/riwayat-siswa', function () {
            return view('admin.riwayat-siswa.index');
        })->name('admin.riwayat-siswa');


        // Export Excel
        Route::get('/export', [
            AdminExportController::class,
            'export'
        ])->name('admin.export');
    });


/*
|--------------------------------------------------------------------------
| TEACHER
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('teacher')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            TeacherDashboardController::class,
            'index'
        ])->name('teacher.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Current Session
        |--------------------------------------------------------------------------
        */

        Route::get('/current', [
            TeacherDashboardController::class,
            'current'
        ])->name('teacher.current');


        /*
        |--------------------------------------------------------------------------
        | My Sessions
        |--------------------------------------------------------------------------
        */

        Route::get('/sessions', [
            TeacherDashboardController::class,
            'sessions'
        ])->name('teacher.sessions');


        /*
        |--------------------------------------------------------------------------
        | Session Detail
        |--------------------------------------------------------------------------
        */

        Route::get('/session', function () {

            $sessionId = request('session');

            $classSession = \App\Models\ClassSession::with([
                'schedule.classRoom.students',
                'schedule.subject',
                'teacher',
                'attendances'
            ])->findOrFail($sessionId);

            $students = $classSession
                ->schedule
                ->classRoom
                ->students;

            return view(
                'teacher.current-session',
                compact(
                    'classSession',
                    'students'
                )
            );

        })->name('teacher.session');


        /*
        |--------------------------------------------------------------------------
        | QR Scanner
        |--------------------------------------------------------------------------
        */

        Route::get('/scan', [
            TeacherScanController::class,
            'scan'
        ])->name('teacher.scan');


        Route::post('/scan/validate', [
            TeacherScanController::class,
            'validateQr'
        ])->name('teacher.scan.validate');


        /*
        |--------------------------------------------------------------------------
        | My Attendance
        |--------------------------------------------------------------------------
        */

        Route::get('/attendance', function () {
            return view('teacher.attendance');
        })->name('teacher.attendance');


        /*
        |--------------------------------------------------------------------------
        | Schedule
        |--------------------------------------------------------------------------
        */

        Route::get('/schedule', function () {
            return view('teacher.schedule');
        })->name('teacher.schedule');


        /*
        |--------------------------------------------------------------------------
        | Session History
        |--------------------------------------------------------------------------
        */

        Route::get('/session-history', function () {
            return view('teacher.session-history');
        })->name('teacher.session-history');


        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        Route::get('/profile', function () {
            return view('teacher.profile');
        })->name('teacher.profile');


        /*
        |--------------------------------------------------------------------------
        | Export Attendance
        |--------------------------------------------------------------------------
        */

        Route::get('/session/{classSession}/export', [
            AttendanceExportController::class,
            'export'
        ])->name('teacher.session.export');

    });


/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('student')
    ->group(function () {

        // Student Dashboard
        Route::get('/dashboard', [
            StudentDashboardController::class,
            'index'
        ])->name('student.dashboard');


        // Student Attendance
        Route::post('/attendance/{classSession}', [
            StudentAttendanceController::class,
            'store'
        ])->name('student.attendance.store');

    });


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

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

});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';