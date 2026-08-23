@extends('layouts.teacher')

@section('title', 'My Sessions')

@section('page-title', 'My Sessions')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">
            My Sessions
        </h1>

        <p class="mt-2 text-slate-500">
            View your teaching sessions.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-200">
            <h2 class="text-xl font-semibold text-slate-900">
                Teaching Sessions
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                History of your teaching activities.
            </p>
        </div>

        @if($sessions->isEmpty())

            <div class="px-6 py-12 text-center">
                <div class="text-4xl mb-4">
                    📚
                </div>

                <h3 class="text-lg font-semibold text-slate-900">
                    No sessions yet
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Your teaching sessions will appear here.
                </p>
            </div>

        @else

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Date
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Class
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Subject
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Start
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-200">

                        @foreach($sessions as $session)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-4 text-sm text-slate-700">
                                    {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">

                                    <div class="font-medium text-slate-900">
                                        {{ $session->schedule->classRoom->name ?? '-' }}
                                    </div>

                                    <div class="text-xs text-slate-500">
                                        {{ $session->schedule->classRoom->room ?? '-' }}
                                    </div>

                                </td>

                                <td class="px-6 py-4 text-sm text-slate-700">
                                    {{ $session->schedule->subject->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-700">
                                    {{ $session->start_time
                                        ? \Carbon\Carbon::parse($session->start_time)->format('H:i')
                                        : '-' }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($session->status === 'ongoing')

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Ongoing
                                        </span>

                                    @elseif($session->status === 'completed')

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                            Completed
                                        </span>

                                    @else

                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                            {{ ucfirst($session->status ?? 'Unknown') }}
                                        </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4 text-right">

                                    <a
                                        href="{{ route('teacher.session', ['classSession' => $session->id]) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium text-sm"
                                    >
                                        View
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

@endsection