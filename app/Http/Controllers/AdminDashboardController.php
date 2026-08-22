<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;
class AdminDashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('auth.admin.dashboard');
    }


    public function siswa()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('auth.admin.siswa.index');
    }


    public function guru()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('auth.admin.guru.index');
    }


    public function kelas()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('auth.admin.kelas.index');
    }


    public function mataPelajaran()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('auth.admin.mata-pelajaran.index');
    }


    public function jadwal()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('auth.admin.jadwal.index');
    }


    public function absensi()
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $attendances = Attendance::with([
        'student',
        'classSession.schedule',
        'classSession.teacher',
    ])
    ->latest('attendance_time')
    ->get();

    return view('auth.admin.absensi.index', compact('attendances'));
}
}