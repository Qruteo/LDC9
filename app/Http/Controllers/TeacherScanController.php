<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherScanController extends Controller
{
    public function scan()
    {
        return view('teacher.scan');
    }

   public function validateQr(Request $request)
{
    $request->validate([
        'qr_token' => 'required|string',
    ]);

    $user = Auth::user();

    $teacher = $user->teacher;

    if (!$teacher) {
        return response()->json([
            'success' => false,
            'message' => 'Akun ini belum terhubung dengan data guru.'
        ], 422);
    }

    $classRoom = ClassRoom::where(
        'qr_token',
        $request->qr_token
    )->first();

    if (!$classRoom) {
        return response()->json([
            'success' => false,
            'message' => 'QR Code kelas tidak valid.'
        ], 404);
    }

    $schedule = Schedule::with([
        'classRoom',
        'subject'
    ])
    ->where('teacher_id', $teacher->id)
    ->where('class_id', $classRoom->id)
    ->first();

    if (!$schedule) {
        return response()->json([
            'success' => false,
            'message' => 'Tidak ada jadwal Anda untuk kelas ini.'
        ], 422);
    }

  $classSession = ClassSession::where('schedule_id', $schedule->id)
    ->where('teacher_id', $teacher->id)
    ->whereDate('session_date', now()->toDateString())
    ->where('status', 'ongoing')
    ->first();

if (!$classSession) {
    $classSession = ClassSession::create([
        'schedule_id' => $schedule->id,
        'teacher_id' => $teacher->id,
        'session_date' => now()->toDateString(),
        'start_time' => now()->format('H:i:s'),
        'status' => 'ongoing',
    ]);
}

    return response()->json([
        'success' => true,

        'teacher' => $user->name,

        'class' => $classRoom->name,

        'room' => $classRoom->room,

        'subject' => $schedule->subject->name,

        'schedule_id' => $schedule->id,

        'session_id' => $classSession->id,
    ]);
}
}