<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use App\Models\Schedule;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherSessionController extends Controller
{
    public function start(Schedule $schedule)
    {
        $user = Auth::user();

        if ($user->role !== 'guru') {
            abort(403);
        }

        $teacher = $user->teacher;

        if (!$teacher || $schedule->teacher_id !== $teacher->id) {
            abort(403, 'Anda tidak memiliki akses ke jadwal ini.');
        }

        $today = now()->toDateString();

        $existingSession = ClassSession::where('schedule_id', $schedule->id)
            ->whereDate('session_date', $today)
            ->first();

        if ($existingSession) {
            return redirect()
                ->route('teacher.dashboard')
                ->with('error', 'Session untuk jadwal ini hari ini sudah dibuat.');
        }

       $scheduleStartTime = Carbon::parse(
    $today . ' ' . $schedule->start_time
);

$endTime = Carbon::parse(
    $today . ' ' . $schedule->end_time
);

$now = now();

if ($now->lt($scheduleStartTime)) {
    return redirect()
        ->route('teacher.dashboard')
        ->with('error', 'Session belum bisa dimulai. Jadwal belum masuk.');
}

if ($endTime->lte($now)) {
    return redirect()
        ->route('teacher.dashboard')
        ->with('error', 'Jadwal ini sudah melewati waktu selesai.');
}

$startTime = $now;

        $classSession = ClassSession::create([
            'schedule_id' => $schedule->id,
            'teacher_id' => $teacher->id,
            'session_date' => $today,
            'start_time' => $startTime,
            'end_time' => null,
            'expires_at' => $endTime,
            'status' => 'ongoing',
        ]);

        return redirect()
            ->route('teacher.session')
            ->with('session', $classSession->id);
    }
public function scan(Request $request)
{
    $user = Auth::user();

    if ($user->role !== 'guru') {
        return response()->json([
            'success' => false,
            'message' => 'Akses ditolak.',
        ], 403);
    }

    $request->validate([
        'qr_token' => 'required|string',
    ]);

    $teacher = $user->teacher;

    if (!$teacher) {
        return response()->json([
            'success' => false,
            'message' => 'Data guru tidak ditemukan.',
        ], 404);
    }

    // Cari kelas berdasarkan QR
    $classRoom = \App\Models\ClassRoom::where(
        'qr_token',
        $request->qr_token
    )->first();

    if (!$classRoom) {
        return response()->json([
            'success' => false,
            'message' => 'QR kelas tidak valid.',
        ], 404);
    }

    // Cari jadwal guru untuk kelas tersebut hari ini
    $schedule = Schedule::with([
        'classRoom',
        'subject',
    ])
    ->where('teacher_id', $teacher->id)
    ->where('class_id', $classRoom->id)
    ->where('day', now()->format('l'))
    ->first();

    if (!$schedule) {
        return response()->json([
            'success' => false,
            'message' => 'Tidak ada jadwal guru untuk kelas ini hari ini.',
        ], 404);
    }

    // Cek apakah session hari ini sudah dibuat
    $existingSession = ClassSession::where('schedule_id', $schedule->id)
        ->whereDate('session_date', now()->toDateString())
        ->where('status', 'ongoing')
        ->first();

    if ($existingSession) {
        return response()->json([
            'success' => true,
            'teacher' => $teacher->user->name,
            'class' => $classRoom->name,
            'room' => $classRoom->room,
            'subject' => $schedule->subject->name,
            'session_id' => $existingSession->id,
        ]);
    }

    // Waktu selesai mengikuti jadwal
    $endTime = Carbon::parse(
        now()->toDateString() . ' ' . $schedule->end_time
    );

    if ($endTime->lte(now())) {
        return response()->json([
            'success' => false,
            'message' => 'Jadwal ini sudah selesai.',
        ], 422);
    }

    // Buat session baru
    $classSession = ClassSession::create([
        'schedule_id' => $schedule->id,
        'teacher_id' => $teacher->id,
        'session_date' => now()->toDateString(),
        'start_time' => now(),
        'end_time' => null,
        'expires_at' => $endTime,
        'status' => 'ongoing',
    ]);

    return response()->json([
        'success' => true,
        'teacher' => $teacher->user->name,
        'class' => $classRoom->name,
        'room' => $classRoom->room,
        'subject' => $schedule->subject->name,
        'session_id' => $classSession->id,
    ]);
}
    public function attendance(Request $request, ClassSession $classSession)
    {
        $user = Auth::user();

        if ($user->role !== 'guru') {
            abort(403);
        }

        if (!$classSession->teacher || $classSession->teacher->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke session ini.');
        }

        if ($classSession->status !== 'ongoing') {
            return back()->with('error', 'Session sudah selesai.');
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'status' => 'required|in:present,late,absent',
            'notes' => 'nullable|string',
        ]);

        $student = $classSession->schedule
            ->classRoom
            ->students()
            ->where('users.id', $validated['student_id'])
            ->first();

        if (!$student) {
            abort(403, 'Siswa tidak terdaftar di kelas ini.');
        }

        Attendance::updateOrCreate(
            [
                'class_session_id' => $classSession->id,
                'student_id' => $validated['student_id'],
            ],
            [
                'status' => $validated['status'],
                'attendance_time' => now(),
                'notes' => $validated['notes'] ?? null,
            ]
        );

        return back()->with('success', 'Absensi berhasil disimpan.');
    }

    public function finish(Request $request, ClassSession $classSession)
    {
        $user = Auth::user();

        if ($user->role !== 'guru') {
            abort(403);
        }

        if ($classSession->status !== 'ongoing') {
            return back()->with('error', 'Session sudah selesai.');
        }

        if (!$classSession->teacher || $classSession->teacher->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke session ini.');
        }

        $request->validate([
            'material' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $classSession->update([
            'material' => $request->material,
            'notes' => $request->notes,
            'end_time' => now(),
            'status' => 'completed',
        ]);

        return redirect()
            ->route('teacher.dashboard')
            ->with('success', 'Session berhasil diselesaikan.');
    }
}