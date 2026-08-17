<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeacherScanController extends Controller
{
    public function scan()
    {
        return view('teacher.scan');
    }

    public function validateQr(Request $request)
    {
        $request->validate([
            'qr_token' => ['required', 'string'],
        ]);

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

        $user = auth()->user();

        $teacher = $user->teacher;

        if (!$teacher) {
            return response()->json([
                'success' => false,
                'message' => 'Akun ini belum terdaftar sebagai guru.'
            ], 403);
        }

        $now = Carbon::now();

        $day = $now->format('l');
        $time = $now->format('H:i:s');

        $schedule = Schedule::with([
            'teacher.user',
            'classRoom',
            'subject'
        ])
        ->where('teacher_id', $teacher->id)
        ->where('class_id', $classRoom->id)
        ->where('day', $day)
        ->whereTime('start_time', '<=', $time)
        ->whereTime('end_time', '>=', $time)
        ->first();

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada jadwal mengajar untuk kelas ini pada waktu sekarang.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil divalidasi.',
            'class' => $classRoom->name,
            'room' => $classRoom->room,
            'subject' => $schedule->subject->name,
            'teacher' => $schedule->teacher->user->name,
            'schedule_id' => $schedule->id,
        ]);
    }
}