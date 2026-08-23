<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ClassSession;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    /**
     * Teacher Dashboard
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'guru') {
            abort(403);
        }

        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        // Jadwal milik guru yang sedang login
        $schedules = Schedule::with([
            'classRoom',
            'subject'
        ])
        ->where('teacher_id', $teacher->id)
        ->orderBy('start_time')
        ->get();

        // Session yang sedang berlangsung
        $currentSession = ClassSession::with([
            'schedule.classRoom',
            'schedule.subject',
            'teacher',
            'attendances'
        ])
        ->where('teacher_id', $teacher->id)
        ->whereDate('session_date', now()->toDateString())
        ->where('status', 'ongoing')
        ->where('expires_at', '>', now())
        ->latest('created_at')
        ->first();

        // Semua session aktif milik guru
        $activeSessions = ClassSession::with([
            'schedule.classRoom',
            'schedule.subject',
            'attendances'
        ])
        ->where('teacher_id', $teacher->id)
        ->whereDate('session_date', now()->toDateString())
        ->where('status', 'ongoing')
        ->where('expires_at', '>', now())
        ->latest('created_at')
        ->get();

        return view('teacher.dashboard', compact(
            'teacher',
            'schedules',
            'currentSession',
            'activeSessions'
        ));
    }


    /**
     * Current Session
     */
    public function current()
    {
        $user = Auth::user();

        if ($user->role !== 'guru') {
            abort(403);
        }

        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Data guru tidak ditemukan.');
        }

        $classSession = ClassSession::with([
            'schedule.classRoom.students',
            'schedule.subject',
            'teacher',
            'attendances'
        ])
        ->where('teacher_id', $teacher->id)
        ->whereDate('session_date', now()->toDateString())
        ->where('status', 'ongoing')
        ->where('expires_at', '>', now())
        ->latest('created_at')
        ->first();

        if (!$classSession) {
            return redirect()
                ->route('teacher.dashboard')
                ->with('error', 'Tidak ada session yang sedang berlangsung.');
        }

        $students = $classSession
            ->schedule
            ->classRoom
            ->students;

        return view('teacher.current-session', compact(
            'classSession',
            'students'
        ));
    }


    /**
     * My Sessions
     */
  /**
 * My Sessions
 */
public function sessions()
{
    $user = Auth::user();

    if ($user->role !== 'guru') {
        abort(403);
    }

    $teacher = $user->teacher;

    if (!$teacher) {
        abort(403, 'Data guru tidak ditemukan.');
    }

    $sessions = ClassSession::with([
        'schedule.classRoom',
        'schedule.subject',
        'attendances'
    ])
    ->where('teacher_id', $teacher->id)
    ->latest('session_date')
    ->latest('start_time')
    ->get();

    return view('teacher.sessions', compact('sessions'));
}
}