<x-app-layout>

```
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <div class="flex">





        <!-- =========================
             CONTENT
        ========================== -->
        <main class="flex-1 p-8">

            <div class="mb-8 flex items-center justify-between">

    <div>

        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
            Session History
        </h1>

        <p class="mt-2 text-gray-500">
            View your previous teaching sessions.
        </p>

    </div>


    <a href="{{ route('teacher.dashboard') }}"
       class="inline-flex items-center gap-2
              px-4 py-2
              bg-blue-600 text-white
              rounded-lg
              hover:bg-blue-700
              transition">

        ← Back to Dashboard

    </a>

</div>

            <!-- =========================
                 SESSION TABLE
            ========================== -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 dark:bg-gray-700">

                            <tr>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Date
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Class
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Subject
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Start
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y dark:divide-gray-700">

                            @forelse($sessions as $session)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">

                                    <!-- Date -->
                                    <td class="px-6 py-4">

                                        {{ \Carbon\Carbon::parse($session->session_date)->format('d M Y') }}

                                    </td>


                                    <!-- Class -->
                                    <td class="px-6 py-4 font-medium">

                                        {{ $session->schedule->classRoom->name }}

                                    </td>


                                    <!-- Subject -->
                                    <td class="px-6 py-4">

                                        {{ $session->schedule->subject->name }}

                                    </td>


                                    <!-- Start -->
                                    <td class="px-6 py-4">

                                        {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }}

                                    </td>


                                    <!-- Status -->
                                    <td class="px-6 py-4">

                                        @if($session->status === 'ongoing')

                                            <span class="px-3 py-1 rounded-full
                                                         text-xs font-semibold
                                                         bg-green-100 text-green-700">

                                                Ongoing

                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full
                                                         text-xs font-semibold
                                                         bg-gray-100 text-gray-700">

                                                {{ ucfirst($session->status) }}

                                            </span>

                                        @endif

                                    </td>


                                    <!-- Action -->
                                    <td class="px-6 py-4">

                                        <a
                                            href="{{ route('teacher.session', ['session' => $session->id]) }}"
                                            class="text-blue-600 font-semibold hover:underline"
                                        >
                                            View
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Belum ada riwayat session.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</div>
```

</x-app-layout>
@extends('layouts.teacher')

@section('title', 'Session History | ClassSync')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-900">
            Session History
        </h1>

        <p class="text-slate-500 mt-2">
            View your previous teaching sessions.
        </p>

    </div>


    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-200">

            <h2 class="text-xl font-bold">
                Teaching Sessions
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                History of your teaching activities.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Class
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Subject
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Time
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-4">
                            XI RPL A
                        </td>

                        <td class="px-6 py-4">
                            Matematika
                        </td>

                        <td class="px-6 py-4">
                            20 Aug 2026
                        </td>

                        <td class="px-6 py-4">
                            08:00 - 09:30
                        </td>

                        <td class="px-6 py-4">

                            <span
                                class="px-3 py-1
                                       rounded-full
                                       bg-green-50
                                       text-green-600
                                       text-sm">

                                Completed

                            </span>

                        </td>

                    </tr>


                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-4">
                            XI RPL B
                        </td>

                        <td class="px-6 py-4">
                            Pemrograman
                        </td>

                        <td class="px-6 py-4">
                            19 Aug 2026
                        </td>

                        <td class="px-6 py-4">
                            10:00 - 11:30
                        </td>

                        <td class="px-6 py-4">

                            <span
                                class="px-3 py-1
                                       rounded-full
                                       bg-green-50
                                       text-green-600
                                       text-sm">

                                Completed

                            </span>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection