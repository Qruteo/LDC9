<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'role' => ['required', 'in:admin,guru,siswa'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'role.required' => 'Silakan pilih jenis pengguna.',
            'role.in' => 'Jenis pengguna tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'Email, password, atau jenis akun tidak sesuai.',
                ])
                ->withInput($request->only('email', 'role'));
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login admin berhasil.');
        }

        if ($user->role === 'guru') {
            return redirect()->route('teacher.dashboard')
                ->with('success', 'Login guru berhasil.');
        }

        if ($user->role === 'siswa') {
            return redirect()->route('student.dashboard')
                ->with('success', 'Login siswa berhasil.');
        }

        Auth::logout();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Role akun tidak dikenali.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
