<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function store(Request $request, ClassSession $classSession)
    {
        $user = Auth::user();

        if ($user->role !== 'siswa') {
            abort(403);
        }

        // Pastikan session masih aktif
        if ($classSession->status !== 'ongoing') {
            return back()->with('error', 'Session absensi sudah selesai.');
        }

        // Pastikan siswa memang terdaftar di kelas tersebut
        $isStudent = $classSession->schedule
            ->classRoom
            ->students()
            ->where('users.id', $user->id)
            ->exists();

        if (!$isStudent) {
            abort(403, 'Anda bukan siswa di kelas ini.');
        }

        // Satu siswa hanya memiliki satu attendance
        // untuk satu class session
        $attendance = Attendance::updateOrCreate(
            [
                'class_session_id' => $classSession->id,
                'student_id' => $user->id,
            ],
            [
                'status' => 'present',
                'attendance_time' => now(),
            ]
        );

        return back()->with('success', 'Absensi berhasil dicatat.');
    }
}