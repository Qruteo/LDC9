<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherSessionController extends Controller
{
    public function finish(Request $request, ClassSession $classSession)
    {
        $user = Auth::user();

        // Pastikan akun adalah guru
        if ($user->role !== 'guru') {
            abort(403);
        }

        // Pastikan session masih aktif
        if ($classSession->status !== 'ongoing') {
            return back()->with('error', 'Session sudah selesai.');
        }

        // Pastikan session milik guru yang sedang login
        if (!$classSession->teacher || $classSession->teacher->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke session ini.');
        }

        // Validasi input
        $request->validate([
            'material' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Selesaikan session
        $classSession->update([
            'material' => $request->material,
            'notes' => $request->notes,
            'end_time' => now(),
            'status' => 'finished',
        ]);

        return redirect()
            ->route('teacher.dashboard')
            ->with('success', 'Session berhasil diselesaikan.');
    }

    public function current()
{
    $user = Auth::user();

    if ($user->role !== 'guru') {
        abort(403);
    }

    $teacher = $user->teacher;

    if (!$teacher) {
        abort(403, 'Akun guru belum terhubung dengan data guru.');
    }

    $sessions = ClassSession::with([
        'schedule.classRoom',
        'schedule.subject',
        'teacher',
        'attendances',
    ])
    ->where('teacher_id', $teacher->id)
    ->whereDate('session_date', now()->toDateString())
    ->where('status', 'ongoing')
    ->latest()
    ->get();

    return view('teacher.current', compact('sessions'));
}
}