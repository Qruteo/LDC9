<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminExportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\TeacherScanController;
use App\Http\Controllers\TeacherSessionController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentAttendanceController;

/*
|--------------------------------------------------------------------------
| HOME & DASHBOARD (ROLE ROUTER)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login');
    }
    if (strtolower($user->role) === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if (strtolower($user->role) === 'guru') {
        return redirect()->route('teacher.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| LOGIN & REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.process');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.alt');
        Route::get('/export', [AdminExportController::class, 'export'])->name('export');

        /*
        | SISWA
        */
        Route::get('/siswa', [AdminDashboardController::class, 'siswa'])->name('siswa');
        Route::get('/siswa/create', [AdminDashboardController::class, 'siswaCreate'])->name('siswa.create');
        Route::post('/siswa', [AdminDashboardController::class, 'siswaStore'])->name('siswa.store');
        Route::get('/siswa/{student}/edit', [AdminDashboardController::class, 'siswaEdit'])->name('siswa.edit');
        Route::put('/siswa/{student}', [AdminDashboardController::class, 'siswaUpdate'])->name('siswa.update');
        Route::delete('/siswa/{student}', [AdminDashboardController::class, 'siswaDestroy'])->name('siswa.destroy');

        /*
        | GURU
        */
        Route::get('/guru', [AdminDashboardController::class, 'guru'])->name('guru');
        Route::get('/guru/create', [AdminDashboardController::class, 'guruCreate'])->name('guru.create');
        Route::post('/guru', [AdminDashboardController::class, 'guruStore'])->name('guru.store');
        Route::get('/guru/{teacher}/edit', [AdminDashboardController::class, 'guruEdit'])->name('guru.edit');
        Route::put('/guru/{teacher}', [AdminDashboardController::class, 'guruUpdate'])->name('guru.update');
        Route::delete('/guru/{teacher}', [AdminDashboardController::class, 'guruDestroy'])->name('guru.destroy');

        /*
        | KELAS
        */
        Route::get('/kelas', [AdminDashboardController::class, 'kelas'])->name('kelas');
        Route::get('/kelas/create', [AdminDashboardController::class, 'kelasCreate'])->name('kelas.create');
        Route::post('/kelas', [AdminDashboardController::class, 'kelasStore'])->name('kelas.store');
        Route::get('/kelas/{classRoom}/edit', [AdminDashboardController::class, 'kelasEdit'])->name('kelas.edit');
        Route::put('/kelas/{classRoom}', [AdminDashboardController::class, 'kelasUpdate'])->name('kelas.update');
        Route::delete('/kelas/{classRoom}', [AdminDashboardController::class, 'kelasDestroy'])->name('kelas.destroy');

        /*
        | SISWA DALAM KELAS
        */
        Route::get('/kelas/{classRoom}/students', [AdminDashboardController::class, 'kelasStudents'])->name('kelas.students');
        Route::post('/kelas/{classRoom}/students', [AdminDashboardController::class, 'kelasStudentStore'])->name('kelas.students.store');
        Route::delete('/kelas/{classRoom}/students/{student}', [AdminDashboardController::class, 'kelasStudentDestroy'])->name('kelas.students.destroy');

        /*
        | MATA PELAJARAN
        */
        Route::get('/mata-pelajaran', [AdminDashboardController::class, 'mataPelajaran'])->name('mata-pelajaran');
        Route::get('/mata-pelajaran/create', [AdminDashboardController::class, 'mataPelajaranCreate'])->name('mata-pelajaran.create');
        Route::post('/mata-pelajaran', [AdminDashboardController::class, 'mataPelajaranStore'])->name('mata-pelajaran.store');
        Route::get('/mata-pelajaran/{subject}/edit', [AdminDashboardController::class, 'mataPelajaranEdit'])->name('mata-pelajaran.edit');
        Route::put('/mata-pelajaran/{subject}', [AdminDashboardController::class, 'mataPelajaranUpdate'])->name('mata-pelajaran.update');
        Route::delete('/mata-pelajaran/{subject}', [AdminDashboardController::class, 'mataPelajaranDestroy'])->name('mata-pelajaran.destroy');

        /*
        | JADWAL
        */
        Route::get('/jadwal', [AdminDashboardController::class, 'jadwal'])->name('jadwal');
        Route::get('/jadwal/create', [AdminDashboardController::class, 'jadwalCreate'])->name('jadwal.create');
        Route::post('/jadwal', [AdminDashboardController::class, 'jadwalStore'])->name('jadwal.store');
        Route::get('/jadwal/{schedule}/edit', [AdminDashboardController::class, 'jadwalEdit'])->name('jadwal.edit');
        Route::put('/jadwal/{schedule}', [AdminDashboardController::class, 'jadwalUpdate'])->name('jadwal.update');
        Route::delete('/jadwal/{schedule}', [AdminDashboardController::class, 'jadwalDestroy'])->name('jadwal.destroy');

        /*
        | ABSENSI
        */
        Route::get('/absensi', [AdminDashboardController::class, 'absensi'])->name('absensi');
        Route::get('/absensi/export', [AdminDashboardController::class, 'absensiExport'])->name('absensi.export');

    });


/*
|--------------------------------------------------------------------------
| TEACHER / GURU
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
        Route::get('/attendance', [TeacherDashboardController::class, 'attendance'])->name('attendance');
        Route::get('/schedule', [TeacherDashboardController::class, 'schedule'])->name('schedule');
        Route::get('/profile', function () {
            return view('teacher.profile');
        })->name('profile');

        /*
        | SCAN QR
        */
        Route::get('/scan', [TeacherScanController::class, 'scan'])->name('scan');
        Route::post('/scan/validate', [TeacherScanController::class, 'validateQr'])->name('scan.validate');

        /*
        | CURRENT SESSION
        */
        Route::get('/session/{classSession}', [TeacherSessionController::class, 'show'])->name('session');
        Route::post('/session/{classSession}/attendance', [TeacherSessionController::class, 'attendance'])->name('session.attendance');
        Route::post('/session/{classSession}/finish', [TeacherSessionController::class, 'finish'])->name('session.finish');
        Route::get('/session/{classSession}/export', [TeacherSessionController::class, 'export'])->name('session.export');

        /*
        | MY SESSIONS
        */
        Route::get('/sessions', [TeacherDashboardController::class, 'sessions'])->name('sessions');
        Route::get('/current-session', [TeacherDashboardController::class, 'current'])->name('current-session');

    });


/*
|--------------------------------------------------------------------------
| STUDENT / SISWA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::post('/session/{classSession}/attendance', [StudentAttendanceController::class, 'store'])->name('attendance.store');

    });