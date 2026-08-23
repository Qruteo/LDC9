<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $sessions = ClassSession::with([
        'schedule.classRoom',
        'schedule.subject',
        'teacher',
    ])
    ->whereHas('schedule.classRoom.students', function ($query) use ($user) {
        $query->where('users.id', $user->id);
    })
    ->where('status', 'ongoing')
    ->where('expires_at', '>', now())
    ->latest()
    ->get();

    return view('student.dashboard', compact('sessions'));
}
}