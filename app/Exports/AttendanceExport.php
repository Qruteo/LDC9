<?php

namespace App\Exports;

use App\Models\Attendance;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $classSessionId;

    public function __construct($classSessionId)
    {
        $this->classSessionId = $classSessionId;
    }

    public function collection(): Collection
    {
        return Attendance::with('student')
            ->where('class_session_id', $this->classSessionId)
            ->get()
            ->map(function ($attendance) {
                return [
                    'Nama Siswa' => $attendance->student->name ?? '-',
                    'Status' => ucfirst($attendance->status),
                    'Waktu Absensi' => $attendance->attendance_time
                        ? $attendance->attendance_time->format('H:i:s')
                        : '-',
                    'Keterangan' => $attendance->notes ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Status',
            'Waktu Absensi',
            'Keterangan',
        ];
    }
}