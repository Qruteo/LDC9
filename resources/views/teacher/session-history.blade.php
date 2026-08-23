@extends('layouts.teacher')

@section('title', 'Session History | ClassSync')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Session History
            </h1>
            <p class="text-slate-500 mt-2">
                View your previous teaching sessions.
            </p>
        </div>

        <a href="{{ route('teacher.dashboard') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition shadow-sm">
            ← Back to Dashboard
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-xl font-bold text-slate-800">
                Teaching Sessions
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                History of all your teaching activities.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Class</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($sessions as $session)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <!-- Date -->
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}
                            </td>

                            <!-- Class -->
                            <td class="px-6 py-4 font-semibold text-slate-900">
                                {{ $session->schedule->classRoom->name ?? '-' }}
                            </td>

                            <!-- Subject -->
                            <td class="px-6 py-4 text-slate-600">
                                {{ $session->schedule->subject->name ?? '-' }}
                            </td>

                            <!-- Time -->
                            <td class="px-6 py-4 text-slate-600">
                                {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }}
                                @if($session->end_time)
                                    - {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                @if($session->status === 'ongoing')
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Ongoing
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ ucfirst($session->status) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-4">
                                <a href="{{ route('teacher.session', ['session' => $session->id]) }}"
                                   class="text-blue-600 hover:text-blue-800 font-semibold hover:underline">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                Belum ada riwayat session.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection