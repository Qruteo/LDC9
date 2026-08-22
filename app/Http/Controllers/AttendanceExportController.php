<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Models\ClassSession;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceExportController extends Controller
{
    public function export(ClassSession $classSession)
    {
        $user = Auth::user();

        // Pastikan akun adalah guru
        if ($user->role !== 'guru') {
            abort(403);
        }

        // Pastikan session memang milik guru yang login
        if (
            !$classSession->teacher ||
            $classSession->teacher->user_id !== $user->id
        ) {
            abort(403, 'Anda tidak memiliki akses ke session ini.');
        }

        // Ambil data session untuk nama file
        $classSession->load([
            'schedule.classRoom',
            'schedule.subject',
        ]);

        $className = $classSession->schedule->classRoom->name ?? 'kelas';
        $subjectName = $classSession->schedule->subject->name ?? 'mapel';

        $date = $classSession->session_date
            ? $classSession->session_date->format('d-m-Y')
            : now()->format('d-m-Y');

        // Bersihkan nama file
        $className = preg_replace('/[^A-Za-z0-9_-]/', '_', $className);
        $subjectName = preg_replace('/[^A-Za-z0-9_-]/', '_', $subjectName);

        $fileName = "attendance_{$className}_{$subjectName}_{$date}.xlsx";

        return Excel::download(
            new AttendanceExport($classSession),
            $fileName
        );
    }
}