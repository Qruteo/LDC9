@extends('layouts.admin')

@section('content')

    <div>
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Rekap Absensi
                </h2>

                <p class="text-gray-500 mt-1">
                    Lihat dan kelola rekap kehadiran siswa.
                </p>
            </div>

            <a href="{{ route('admin.absensi.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-sm transition">
                📊 Export Rekap Absensi
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Siswa</th>
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Waktu</th>
                            <th class="px-6 py-4 font-semibold">Catatan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $attendance->student?->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $attendance->classSession?->session_date?->format('d/m/Y') ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ ucfirst($attendance->status) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $attendance->attendance_time?->format('H:i') ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $attendance->notes ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data absensi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection