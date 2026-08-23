@extends('layouts.teacher')

@section('title', 'Teaching Session | ClassSync')

@section('page-title', 'Teaching Session')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- =========================
         HEADER
    ========================== -->

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-900">
                Teaching Session
            </h1>

            <p class="mt-2 text-slate-500">
                Detail kehadiran siswa pada session ini.
            </p>

        </div>


        <div class="flex items-center gap-3">

            <!-- Back -->

            <a
                href="{{ route('teacher.sessions') }}"
                class="inline-flex items-center gap-2
                       px-4 py-2
                       bg-slate-100
                       text-slate-700
                       rounded-lg
                       hover:bg-slate-200
                       transition"
            >
                ← Back
            </a>


            <!-- Export -->

            <a
                href="{{ route('teacher.session.export', [
                    'classSession' => $classSession->id
                ]) }}"
                class="inline-flex items-center gap-2
                       px-4 py-2
                       bg-green-600
                       text-white
                       rounded-lg
                       hover:bg-green-700
                       transition"
            >
                📊 Export Excel
            </a>


            <!-- Finish Session -->

            @if($classSession->status === 'ongoing')

                <form
                    method="POST"
                    action="{{ route('teacher.session.finish', [
                        'classSession' => $classSession->id
                    ]) }}"
                    onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan session ini?')"
                >

                    @csrf

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2
                               px-4 py-2
                               bg-red-600
                               text-white
                               rounded-lg
                               font-semibold
                               hover:bg-red-700
                               transition"
                    >
                        ✓ Finish Session
                    </button>

                </form>

            @endif

        </div>

    </div>


    <!-- =========================
         SESSION INFORMATION
    ========================== -->

    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm p-6 mb-8">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h2 class="text-xl font-bold text-slate-900">

                    {{ $classSession->schedule->classRoom->name ?? '-' }}

                </h2>

                <p class="text-slate-500 mt-1">

                    {{ $classSession->schedule->subject->name ?? '-' }}

                </p>

            </div>


            <!-- STATUS -->

            @if($classSession->status === 'ongoing')

                <span
                    class="inline-flex items-center gap-2
                           px-4 py-2
                           rounded-full
                           text-sm font-semibold
                           bg-green-100
                           text-green-700"
                >

                    <span class="w-2 h-2 rounded-full bg-green-500"></span>

                    Ongoing

                </span>

            @elseif($classSession->status === 'completed')

                <span
                    class="inline-flex items-center
                           px-4 py-2
                           rounded-full
                           text-sm font-semibold
                           bg-blue-100
                           text-blue-700"
                >

                    Completed

                </span>

            @elseif($classSession->status === 'expired')

                <span
                    class="inline-flex items-center
                           px-4 py-2
                           rounded-full
                           text-sm font-semibold
                           bg-red-100
                           text-red-700"
                >

                    Expired

                </span>

            @else

                <span
                    class="inline-flex items-center
                           px-4 py-2
                           rounded-full
                           text-sm font-semibold
                           bg-slate-100
                           text-slate-700"
                >

                    {{ ucfirst($classSession->status ?? 'Unknown') }}

                </span>

            @endif

        </div>


        <!-- SESSION DETAILS -->

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- CLASS -->

            <div>

                <p class="text-sm text-slate-500">
                    Class
                </p>

                <p class="mt-1 text-lg font-bold text-slate-900">

                    {{ $classSession->schedule->classRoom->name ?? '-' }}

                </p>

                <p class="text-sm text-slate-500">

                    {{ $classSession->schedule->classRoom->room ?? '-' }}

                </p>

            </div>


            <!-- SUBJECT -->

            <div>

                <p class="text-sm text-slate-500">
                    Subject
                </p>

                <p class="mt-1 text-lg font-bold text-slate-900">

                    {{ $classSession->schedule->subject->name ?? '-' }}

                </p>

            </div>


            <!-- DATE -->

            <div>

                <p class="text-sm text-slate-500">
                    Date
                </p>

                <p class="mt-1 text-lg font-bold text-slate-900">

                    {{ \Carbon\Carbon::parse(
                        $classSession->session_date
                    )->format('d M Y') }}

                </p>

            </div>


            <!-- START -->

            <div>

                <p class="text-sm text-slate-500">
                    Start
                </p>

                <p class="mt-1 text-lg font-bold text-slate-900">

                    {{ \Carbon\Carbon::parse(
                        $classSession->start_time
                    )->format('H:i') }}

                </p>

            </div>

        </div>

    </div>


    <!-- =========================
         STUDENT ATTENDANCE
    ========================== -->

    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-200">

            <h2 class="text-xl font-bold text-slate-900">
                Student Attendance
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Daftar siswa pada session ini.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left
                                   text-sm font-semibold
                                   text-slate-600">
                            No
                        </th>

                        <th class="px-6 py-4 text-left
                                   text-sm font-semibold
                                   text-slate-600">
                            Student
                        </th>

                        <th class="px-6 py-4 text-left
                                   text-sm font-semibold
                                   text-slate-600">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-200">

                    @forelse($students as $index => $student)

                        @php

                            $attendance = $classSession->attendances
                                ->where('student_id', $student->id)
                                ->first();

                        @endphp


                        <tr class="hover:bg-slate-50 transition">

                            <!-- NO -->

                            <td class="px-6 py-4 text-sm text-slate-600">

                                {{ $index + 1 }}

                            </td>


                            <!-- STUDENT -->

                            <td class="px-6 py-4">

                                <div class="font-medium text-slate-900">

                                    {{ $student->name }}

                                </div>

                            </td>


                            <!-- STATUS -->

                            <td class="px-6 py-4">

                                @if($attendance)

                                    <span
                                        class="inline-flex
                                               px-3 py-1
                                               rounded-full
                                               text-xs font-semibold
                                               bg-green-100
                                               text-green-700"
                                    >

                                        {{ ucfirst($attendance->status) }}

                                    </span>

                                @else

                                    <span
                                        class="inline-flex
                                               px-3 py-1
                                               rounded-full
                                               text-xs font-semibold
                                               bg-slate-100
                                               text-slate-600"
                                    >

                                        Belum Absen

                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="3"
                                class="px-6 py-12
                                       text-center
                                       text-slate-500"
                            >

                                Belum ada siswa di kelas ini.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection