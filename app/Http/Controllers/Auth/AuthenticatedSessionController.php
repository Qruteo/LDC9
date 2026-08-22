<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Proses login
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Ambil user yang sedang login
        $user = Auth::user();

        // Jika guru
        if ($user->role === 'guru') {
            return redirect()->route('teacher.dashboard');
        }

        // Jika siswa
        if ($user->role === 'siswa') {
            return redirect()->route('student.dashboard');
        }

        // Jika role tidak dikenali
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}