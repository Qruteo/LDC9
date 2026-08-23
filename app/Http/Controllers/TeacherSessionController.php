<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherSessionController extends Controller
{
    /**
     * Menampilkan detail teaching session.
     */
    public function show(ClassSession $classSession)
    {
        $user = Auth::user();

        // Pastikan user sudah login dan merupakan guru
        if (!$user || $user->role !== 'guru') {
            abort(403);
        }

        // Pastikan session milik guru yang sedang login
        if (
            !$classSession->teacher ||
            $classSession->teacher->user_id !== $user->id
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke session ini.'
            );
        }

        // Load relasi yang dibutuhkan view
        $classSession->load([
            'schedule.classRoom',
            'schedule.subject',
            'attendances',
        ]);

        // Ambil semua siswa yang terdaftar di kelas
        $students = $classSession
            ->schedule
            ->classRoom
            ->students()
            ->get();

        return view('teacher.current-session', [
            'classSession' => $classSession,
            'students' => $students,
        ]);
    }


    /**
     * Menyimpan / memperbarui absensi siswa.
     */
    public function attendance(
        Request $request,
        ClassSession $classSession
    ) {
        $user = Auth::user();

        // Pastikan guru
        if (!$user || $user->role !== 'guru') {
            abort(403);
        }

        // Pastikan session milik guru yang login
        if (
            !$classSession->teacher ||
            $classSession->teacher->user_id !== $user->id
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke session ini.'
            );
        }

        // Session harus masih ongoing
        if ($classSession->status !== 'ongoing') {
            return back()->with(
                'error',
                'Session sudah selesai.'
            );
        }

        // Validasi data absensi
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'status' => 'required|in:present,late,absent',
            'notes' => 'nullable|string',
        ]);

        // Pastikan siswa memang berada di kelas session
        $student = $classSession
            ->schedule
            ->classRoom
            ->students()
            ->where(
                'users.id',
                $validated['student_id']
            )
            ->first();

        if (!$student) {
            abort(
                403,
                'Siswa tidak terdaftar di kelas ini.'
            );
        }

        // Simpan / update absensi
        Attendance::updateOrCreate(
            [
                'class_session_id' => $classSession->id,
                'student_id' => $validated['student_id'],
            ],
            [
                'status' => $validated['status'],
                'attendance_time' => now(),
                'notes' => $validated['notes'] ?? null,
            ]
        );

        return back()->with(
            'success',
            'Absensi berhasil disimpan.'
        );
    }


    /**
     * Menyelesaikan teaching session.
     */
    public function finish(
        Request $request,
        ClassSession $classSession
    ) {
        $user = Auth::user();

        // Pastikan guru
        if (!$user || $user->role !== 'guru') {
            abort(403);
        }

        // Pastikan session milik guru yang login
        if (
            !$classSession->teacher ||
            $classSession->teacher->user_id !== $user->id
        ) {
            abort(
                403,
                'Anda tidak memiliki akses ke session ini.'
            );
        }

        // Tidak boleh finish dua kali
        if ($classSession->status !== 'ongoing') {
            return back()->with(
                'error',
                'Session sudah selesai.'
            );
        }

        // Validasi catatan akhir session
        $validated = $request->validate([
            'material' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Selesaikan session
        $classSession->update([
            'material' => $validated['material'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'end_time' => now(),
            'status' => 'completed',
        ]);

        return redirect()
            ->route('teacher.dashboard')
            ->with(
                'success',
                'Session berhasil diselesaikan.'
            );
    }
}