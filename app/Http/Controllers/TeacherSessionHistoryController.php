<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Support\Facades\Auth;

class TeacherSessionHistoryController extends Controller
{
    public function index()
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
            'attendances',
        ])
        ->where('teacher_id', $teacher->id)
        ->where('status', 'finished')
        ->latest('session_date')
        ->latest('start_time')
        ->get();

        return view('teacher.sessions', compact('sessions'));
    }
}