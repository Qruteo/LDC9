@extends('layouts.teacher')

@section('title', 'Detail Sesi Mengajar | ClassSync')

@section('page-title', 'Detail Sesi Mengajar')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
            <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs font-bold shrink-0">✓</span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium">
            <span class="w-6 h-6 rounded-full bg-rose-500 text-white flex items-center justify-center text-xs font-bold shrink-0">!</span>
            {{ session('error') }}
        </div>
    @endif


    {{-- =====================
         HEADER + ACTIONS
    ====================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Detail Sesi Mengajar</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola presensi siswa dan lihat rekap kehadiran sesi ini.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('teacher.sessions') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-semibold hover:bg-slate-50 transition shadow-sm">
                ← Kembali
            </a>

            <a href="{{ route('teacher.session.export', ['classSession' => $classSession->id]) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold transition shadow-sm shadow-emerald-500/20">
                📊 Export CSV
            </a>

            @if($classSession->status === 'ongoing')
                <form method="POST"
                      action="{{ route('teacher.session.finish', ['classSession' => $classSession->id]) }}"
                      onsubmit="return confirm('Yakin ingin menyelesaikan sesi ini?')">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold transition shadow-sm shadow-rose-500/20">
                        ✓ Selesaikan Sesi
                    </button>
                </form>
            @endif
        </div>
    </div>


    {{-- =====================
         SESSION INFO CARD
    ====================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-5">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-50 to-indigo-100 text-blue-600 flex items-center justify-center text-2xl font-black border border-blue-100 shrink-0">
                    📖
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900 leading-tight">
                        {{ $classSession->schedule?->subject?->name ?? '-' }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-0.5 font-medium">
                        {{ $classSession->schedule?->classRoom?->name ?? '-' }}
                        @if($classSession->schedule?->classRoom?->room)
                            <span class="text-slate-300 mx-1">•</span>
                            {{ $classSession->schedule->classRoom->room }}
                        @endif
                    </p>
                </div>
            </div>

            @if($classSession->status === 'ongoing')
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 self-start">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Sedang Berlangsung
                </span>
            @elseif($classSession->status === 'completed')
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 self-start">
                    ✓ Selesai
                </span>
            @else
                <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-slate-100 text-slate-600 self-start">
                    {{ ucfirst($classSession->status ?? 'Unknown') }}
                </span>
            @endif
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-4 border-t border-slate-100">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Tanggal</p>
                <p class="text-sm font-bold text-slate-800">
                    {{ \Carbon\Carbon::parse($classSession->session_date)->isoFormat('D MMMM Y') }}
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Jam Mulai</p>
                <p class="text-sm font-bold text-slate-800">
                    {{ \Carbon\Carbon::parse($classSession->start_time)->format('H:i') }} WIB
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Berakhir</p>
                <p class="text-sm font-bold text-slate-800">
                    {{ \Carbon\Carbon::parse($classSession->expires_at)->format('H:i') }} WIB
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wide mb-1">Kehadiran</p>
                @php
                    $hadirCount = $classSession->attendances->whereIn('status', ['hadir','present'])->count();
                    $totalCount = $students->count();
                @endphp
                <p class="text-sm font-bold text-slate-800">
                    <span class="text-emerald-600">{{ $hadirCount }}</span>
                    <span class="text-slate-400 font-normal"> / {{ $totalCount }} siswa</span>
                </p>
            </div>
        </div>
    </div>


    {{-- =====================
         ATTENDANCE TABLE
    ====================== --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-900">Daftar Presensi Siswa</h3>
                <p class="text-xs text-slate-500 mt-0.5">Klik tag status untuk mengubah kehadiran siswa</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                {{ $totalCount }} Siswa Terdaftar
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider w-10">No</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Waktu Presensi</th>
                        <th class="px-6 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($students as $index => $student)
                        @php
                            $attendance = $classSession->attendances
                                ->where('student_id', $student->id)
                                ->first();

                            $status = $attendance?->status ?? null;
                        @endphp

                        <tr class="hover:bg-slate-50/60 transition">
                            {{-- NO --}}
                            <td class="px-6 py-4 text-sm text-slate-400 font-medium">
                                {{ $index + 1 }}
                            </td>

                            {{-- STUDENT --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center text-xs font-bold shrink-0">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $student->name }}</p>
                                        @if($student->nis)
                                            <p class="text-xs text-slate-400">NIS: {{ $student->nis }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- WAKTU --}}
                            <td class="px-6 py-4 text-sm text-slate-500">
                                @if($attendance?->attendance_time)
                                    {{ $attendance->attendance_time->format('H:i') }} WIB
                                @else
                                    <span class="text-slate-300">—</span>
                                @endif
                            </td>

                            {{-- STATUS TAGS --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap items-center gap-1.5">

                                    {{-- HADIR --}}
                                    <form method="POST" action="{{ route('teacher.session.attendance', ['classSession' => $classSession->id]) }}">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="status" value="hadir">
                                        <button type="submit" title="Tandai Hadir"
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition
                                            {{ in_array($status, ['hadir','present'])
                                                ? 'bg-emerald-500 text-white border-emerald-500 shadow-sm'
                                                : 'bg-white text-emerald-600 border-emerald-300 hover:bg-emerald-50' }}">
                                            Hadir
                                        </button>
                                    </form>

                                    {{-- IZIN --}}
                                    <form method="POST" action="{{ route('teacher.session.attendance', ['classSession' => $classSession->id]) }}">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="status" value="izin">
                                        <button type="submit" title="Tandai Izin"
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition
                                            {{ $status === 'izin'
                                                ? 'bg-blue-500 text-white border-blue-500 shadow-sm'
                                                : 'bg-white text-blue-600 border-blue-300 hover:bg-blue-50' }}">
                                            Izin
                                        </button>
                                    </form>

                                    {{-- SAKIT --}}
                                    <form method="POST" action="{{ route('teacher.session.attendance', ['classSession' => $classSession->id]) }}">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="status" value="sakit">
                                        <button type="submit" title="Tandai Sakit"
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition
                                            {{ $status === 'sakit'
                                                ? 'bg-amber-500 text-white border-amber-500 shadow-sm'
                                                : 'bg-white text-amber-600 border-amber-300 hover:bg-amber-50' }}">
                                            Sakit
                                        </button>
                                    </form>

                                    {{-- ALFA --}}
                                    <form method="POST" action="{{ route('teacher.session.attendance', ['classSession' => $classSession->id]) }}">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="status" value="alfa">
                                        <button type="submit" title="Tandai Alfa"
                                            class="px-3 py-1.5 rounded-lg text-xs font-bold border transition
                                            {{ in_array($status, ['alfa','absent'])
                                                ? 'bg-rose-500 text-white border-rose-500 shadow-sm'
                                                : 'bg-white text-rose-600 border-rose-300 hover:bg-rose-50' }}">
                                            Alfa
                                        </button>
                                    </form>

                                    {{-- BADGE jika belum absen --}}
                                    @if(!$attendance)
                                        <span class="ml-1 px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-400 border border-slate-200">
                                            Belum Absen
                                        </span>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center text-3xl">👤</div>
                                    <p class="text-sm font-semibold text-slate-500">Belum ada siswa terdaftar di kelas ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection