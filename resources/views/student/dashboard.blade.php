@extends('layouts.student')

@section('title', 'Dashboard Siswa | ClassSync')
@section('page-title', 'Dashboard Siswa')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    {{-- ALERT SUCCESS --}}
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


    {{-- HERO CARD --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 sm:p-8 shadow-lg shadow-blue-500/20">
        <div class="absolute -right-8 -top-8 w-40 h-40 bg-white/10 rounded-full pointer-events-none"></div>
        <div class="absolute right-16 -bottom-12 w-28 h-28 bg-white/10 rounded-full pointer-events-none"></div>

        <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mb-1">ClassSync Student</p>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Halo, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-blue-100 text-sm mt-2">
                    Pantau sesi kelas aktif dan lakukan presensi kehadiran Anda.
                </p>
            </div>
            <div class="flex items-center gap-3 bg-white/15 border border-white/20 rounded-xl p-3.5 self-start sm:self-auto shrink-0">
                <div class="w-11 h-11 rounded-full bg-white text-blue-600 flex items-center justify-center font-black text-lg">
                    {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-sm leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-blue-200 text-xs mt-0.5">NIS: {{ Auth::user()->nis ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>


    {{-- STATS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Sesi Aktif</p>
                    <p class="text-3xl font-extrabold text-slate-900 mt-1.5">{{ $sessions->count() }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">📚</div>
            </div>
            <p class="text-xs text-slate-400 mt-3">Kelas yang sedang berlangsung</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Status Akun</p>
                    <p class="text-lg font-extrabold text-emerald-600 mt-1.5">Aktif</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">✓</div>
            </div>
            <p class="text-xs text-slate-400 mt-3">Terdaftar di sistem ClassSync</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Hari Ini</p>
                    <p class="text-base font-extrabold text-slate-900 mt-1.5">{{ now()->isoFormat('D MMM Y') }}</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">📅</div>
            </div>
            <p class="text-xs text-slate-400 mt-3">{{ now()->format('H:i') }} WIB</p>
        </div>

    </div>


    {{-- ACTIVE SESSIONS --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Sesi Kelas Berlangsung</h2>
                <p class="text-xs text-slate-500 mt-0.5">Tekan tombol presensi untuk mencatat kehadiran Anda</p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">
                {{ $sessions->count() }} Aktif
            </span>
        </div>

        {{-- List --}}
        <div class="divide-y divide-slate-100">
            @forelse($sessions as $session)
                @php
                    $alreadyAttended = $session->attendances->isNotEmpty();
                    $att = $session->attendances->first();
                @endphp

                <div class="p-6 hover:bg-slate-50/60 transition">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                        {{-- Info --}}
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold shrink-0 border border-blue-100">
                                📖
                            </div>
                            <div class="space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-sm font-bold text-slate-900">
                                        {{ $session->schedule?->subject?->name ?? 'Mata Pelajaran' }}
                                    </h3>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        {{ $session->schedule?->classRoom?->name ?? 'Kelas' }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500">
                                    👨‍🏫 <span class="font-medium text-slate-700">{{ $session->teacher?->user?->name ?? '-' }}</span>
                                    <span class="text-slate-300 mx-1.5">•</span>
                                    🕒 {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }}–{{ \Carbon\Carbon::parse($session->expires_at)->format('H:i') }} WIB
                                </p>
                                <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Sesi Berlangsung
                                </span>
                            </div>
                        </div>

                        {{-- Action --}}
                        <div class="shrink-0">
                            @if($alreadyAttended)
                                <div class="inline-flex items-center gap-2.5 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200">
                                    <span class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-xs">✓</span>
                                    <div>
                                        <p class="text-xs font-bold text-emerald-900">Sudah Hadir</p>
                                        <p class="text-[11px] text-emerald-600">{{ $att?->attendance_time?->format('H:i') ?? '-' }} WIB</p>
                                    </div>
                                </div>
                            @else
                                <form method="POST" action="{{ route('student.attendance.store', $session) }}">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-sm shadow-blue-500/20 transition active:scale-[0.98]">
                                        🙋‍♂️ Saya Hadir
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                </div>

            @empty
                <div class="py-16 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 text-3xl flex items-center justify-center mx-auto border border-slate-200">
                        📅
                    </div>
                    <h3 class="mt-4 text-sm font-bold text-slate-700">Tidak Ada Sesi Aktif</h3>
                    <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">
                        Belum ada sesi presensi yang dibuka guru di kelas Anda saat ini.
                    </p>
                </div>
            @endforelse
        </div>

    </div>

</div>

@endsection