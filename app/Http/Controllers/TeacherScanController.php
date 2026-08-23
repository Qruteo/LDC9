<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Schedule;
use App\Models\ClassSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherScanController extends Controller
{
    /**
     * Menampilkan halaman scanner QR.
     */
    public function scan()
    {
        return view('teacher.scan');
    }


    /**
     * Memvalidasi QR kelas dan membuka/membuat teaching session.
     */
    public function validateQr(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string',
        ]);

        $user = Auth::user();

        // Pastikan user adalah guru
        if (!$user || $user->role !== 'guru') {
            abort(403, 'Akses ditolak.');
        }

        $teacher = $user->teacher;

        if (!$teacher) {
            abort(403, 'Akun ini belum terhubung dengan data guru.');
        }


        // =================================================
        // 1. CARI KELAS BERDASARKAN QR
        // =================================================

        $classRoom = ClassRoom::where(
            'qr_token',
            $request->qr_token
        )->first();

        if (!$classRoom) {
            return back()
                ->with('error', 'QR Code kelas tidak valid.');
        }


        // =================================================
        // 2. CARI JADWAL GURU UNTUK KELAS TERSEBUT
        // =================================================

        $schedule = Schedule::with([
            'classRoom',
            'subject',
        ])
        ->where('teacher_id', $teacher->id)
        ->where('class_id', $classRoom->id)
        ->where('day', now()->format('l'))
        ->first();

        if (!$schedule) {
            return back()
                ->with(
                    'error',
                    'Tidak ada jadwal Anda untuk kelas ini hari ini.'
                );
        }


        // =================================================
        // 3. TENTUKAN WAKTU JADWAL
        // =================================================

        $today = now()->toDateString();

        $startTime = Carbon::parse(
            $today . ' ' . $schedule->start_time
        );

        $endTime = Carbon::parse(
            $today . ' ' . $schedule->end_time
        );

        $now = now();


        // =================================================
        // 4. CEK JADWAL BELUM DIMULAI
        // =================================================

        if ($now->lt($startTime)) {
            return back()
                ->with(
                    'error',
                    'Session belum bisa dimulai. Jadwal belum masuk.'
                );
        }


        // =================================================
        // 5. CEK JADWAL SUDAH SELESAI
        // =================================================

        if ($endTime->lte($now)) {
            return back()
                ->with(
                    'error',
                    'Jadwal ini sudah melewati waktu selesai.'
                );
        }


        // =================================================
        // 6. CARI SESSION HARI INI
        // =================================================

        $classSession = ClassSession::where(
            'schedule_id',
            $schedule->id
        )
        ->where(
            'teacher_id',
            $teacher->id
        )
        ->whereDate(
            'session_date',
            $today
        )
        ->latest('created_at')
        ->first();


        // =================================================
        // 7. JIKA SESSION MASIH AKTIF
        // =================================================

        if ($classSession && $classSession->isActive()) {

            return redirect()
                ->route('teacher.session', [
                    'session' => $classSession->id,
                ]);
        }


        // =================================================
        // 8. JIKA SESSION LAMA SUDAH SELESAI
        //    BUAT SESSION BARU
        // =================================================

        $classSession = ClassSession::create([
            'schedule_id' => $schedule->id,
            'teacher_id' => $teacher->id,
            'session_date' => $today,
            'start_time' => $now,
            'end_time' => null,
            'expires_at' => $endTime,
            'status' => 'ongoing',
        ]);


        // =================================================
        // 9. BUKA TEACHING SESSION
        // =================================================

        return redirect()
            ->route('teacher.session', [
                'session' => $classSession->id,
            ]);
    }
}