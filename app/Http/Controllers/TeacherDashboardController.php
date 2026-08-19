<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'guru') {
            abort(403, 'Anda tidak memiliki akses ke dashboard guru.');
        }

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
    }
}