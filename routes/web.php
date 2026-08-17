<?php

use App\Models\ClassRoom;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherScanController;
use Illuminate\Support\Facades\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeacherDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('teacher.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
// Teacher Dashboard
Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])
    ->name('teacher.dashboard');


    // Teacher Dashboard
   Route::get('/teacher/dashboard', function () {

    $user = Auth::user();

    $teacher = $user->teacher;

    $schedules = collect();

    if ($teacher) {
        $schedules = Schedule::with([
            'classRoom',
            'subject'
        ])
        ->where('teacher_id', $teacher->id)
        ->orderBy('start_time')
        ->get();
    }

    return view('teacher.dashboard', compact('schedules'));

})->name('teacher.dashboard');


    // QR Scanner
    Route::get('/teacher/scan', [TeacherScanController::class, 'scan'])
        ->name('teacher.scan');

    Route::post('/teacher/scan/validate', [TeacherScanController::class, 'validateQr'])
        ->name('teacher.scan.validate');


    // Teacher Session
    Route::get('/teacher/session', function () {

        $qrToken = request('class');

        $classRoom = ClassRoom::where('qr_token', $qrToken)->first();

        if (!$classRoom) {
            abort(404, 'QR Code kelas tidak valid.');
        }

        return view('teacher.session', compact('classRoom'));

    })->name('teacher.session');

});
Route::middleware('auth')->group(function () {
    // Rute Profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';