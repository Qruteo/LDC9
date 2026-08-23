<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminTeacherController extends Controller
{
    /**
     * Menampilkan daftar guru.
     */
    public function index()
    {
        $this->checkAdmin();

        $teachers = Teacher::with('user')
            ->latest()
            ->get();

        return view('auth.admin.guru.index', compact('teachers'));
    }

    /**
     * Form tambah guru.
     */
    public function create()
    {
        $this->checkAdmin();

        return view('auth.admin.guru.create');
    }

    /**
     * Simpan guru baru.
     */
    public function store(Request $request)
    {
        $this->checkAdmin();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'teacher_code' => [
                'required',
                'string',
                'max:50',
                'unique:teachers,teacher_code',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'guru',
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'teacher_code' => $validated['teacher_code'],
        ]);

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Form edit guru.
     */
    public function edit(Teacher $teacher)
    {
        $this->checkAdmin();

        $teacher->load('user');

        return view('auth.admin.guru.edit', compact('teacher'));
    }

    /**
     * Update guru.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $this->checkAdmin();

        $teacher->load('user');

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($teacher->user_id),
            ],

            'teacher_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('teachers', 'teacher_code')
                    ->ignore($teacher->id),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $teacher->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $teacher->user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        $teacher->update([
            'teacher_code' => $validated['teacher_code'],
        ]);

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Hapus guru.
     */
    public function destroy(Teacher $teacher)
    {
        $this->checkAdmin();

        $teacher->load('user');

        if (!$teacher->user) {
            $teacher->delete();

            return redirect()
                ->route('admin.guru')
                ->with('success', 'Data guru berhasil dihapus.');
        }

        $teacher->user->delete();

        return redirect()
            ->route('admin.guru')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    /**
     * Pastikan hanya admin.
     */
    private function checkAdmin(): void
    {
        if (!auth()->check() || strtolower(auth()->user()->role) !== 'admin') {
            abort(403);
        }
    }
}