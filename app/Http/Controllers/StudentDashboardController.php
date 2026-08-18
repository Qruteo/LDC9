<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        $classes = $student->classes;

        return view('student.dashboard', compact(
            'student',
            'classes'
        ));
    }
}