<x-app-layout>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <div class="flex">

            <!-- Sidebar -->
            <aside class="w-64 min-h-screen bg-white dark:bg-gray-800 shadow-md">

                <!-- Logo -->
                <div class="p-6 border-b dark:border-gray-700">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">✓</span>
                        </div>

                        <span class="text-xl font-bold text-blue-600">
                            Attendfy
                        </span>

                    </div>

                </div>


                <!-- Navigation -->
                <nav class="p-4 space-y-2">

                    <a href="{{ route('teacher.dashboard') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">

                        <span>🏠</span>
                        <span>Dashboard</span>

                    </a>

                    <a href="{{ route('teacher.scan') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">

                        <span>📷</span>
                        <span>Scan QR</span>

                    </a>

                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white">

                        <span>📚</span>
                        <span>Current Session</span>

                    </a>

                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">

                        <span>🕐</span>
                        <span>My Attendance</span>

                    </a>

                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">

                        <span>📅</span>
                        <span>Schedule</span>

                    </a>

                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">

                        <span>👤</span>
                        <span>Profile</span>

                    </a>

                </nav>

            </aside>


            <!-- Main Content -->
            <main class="flex-1 p-8">

                <!-- Header -->
                <div class="mb-8">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-blue-600">
                                ACTIVE CLASS SESSION
                            </p>

                            <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">
    {{ $classSession->schedule->classRoom->name }}
</h1>

<p class="mt-2 text-xs text-gray-400">
    QR: {{ $classSession->schedule->classRoom->qr_token }}
</p>

<p class="mt-2 text-gray-500 dark:text-gray-400">
    {{ $classSession->schedule->subject->name }}
</p>

                        </div>


                        <!-- Session Status -->
                        <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 dark:bg-green-900/20">

                            <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>

                            <span class="text-sm font-semibold text-green-700 dark:text-green-400">
                                Session Active
                            </span>

                        </div>

                    </div>

                </div>


                <!-- Session Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- Date -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Date
        </p>

        <p class="mt-2 text-lg font-bold text-gray-900 dark:text-white">
            {{ \Carbon\Carbon::parse($classSession->session_date)->format('l, d F Y') }}
        </p>

    </div>


    <!-- Start Time -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Start Time
        </p>

        <p class="mt-2 text-lg font-bold text-gray-900 dark:text-white">
            {{ $classSession->start_time
                ? \Carbon\Carbon::parse($classSession->start_time)->format('H:i')
                : '-' }}
        </p>

    </div>


    <!-- Classroom -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Classroom
        </p>

        <p class="mt-2 text-lg font-bold text-gray-900 dark:text-white">
            {{ $classSession->schedule->classRoom->name }}
        </p>

    </div>

</div>
                <!-- Learning Material -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Learning Material
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Enter the material taught during this session.
                    </p>


                    <div class="mt-5">

                        <label for="material"
                               class="block text-sm font-medium text-gray-700 dark:text-gray-300">

                            Material

                        </label>

                        <input
                            id="material"
                            type="text"
                            placeholder="Contoh: Parabola"
                            class="mt-2 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                        >

                    </div>

                </div>


                <!-- Student Attendance -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                Student Attendance
                            </h2>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Mark students who are absent.
                            </p>

                        </div>

                       <span class="text-sm font-medium text-gray-500">
    {{ $students->count() }} Students
</span>

                    </div>


                    <div class="mt-5 space-y-3">


                        <!-- Student -->
                        <div class="space-y-3">

    @forelse($students as $student)

    @php
        $attendance = $classSession->attendances
            ->where('student_id', $student->id)
            ->first();
    @endphp

    <div class="flex items-center justify-between
                bg-white dark:bg-gray-800
                rounded-xl shadow-sm p-4">

        <div class="flex items-center gap-4">

            <div class="w-10 h-10 rounded-full
                        bg-blue-100 dark:bg-blue-900/30
                        flex items-center justify-center">

                <span class="font-bold text-blue-600">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </span>

            </div>

            <div>
                <p class="font-semibold text-gray-900 dark:text-white">
                    {{ $student->name }}
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $student->email }}
                </p>
            </div>

        </div>

        @if($attendance)

            @if($attendance->status === 'present')

                <span class="px-3 py-1 rounded-full
                             bg-green-100 text-green-700
                             text-sm font-medium">
                    Present
                </span>

            @elseif($attendance->status === 'late')

                <span class="px-3 py-1 rounded-full
                             bg-yellow-100 text-yellow-700
                             text-sm font-medium">
                    Late
                </span>

            @elseif($attendance->status === 'excused')

                <span class="px-3 py-1 rounded-full
                             bg-blue-100 text-blue-700
                             text-sm font-medium">
                    Excused
                </span>

            @elseif($attendance->status === 'absent')

                <span class="px-3 py-1 rounded-full
                             bg-red-100 text-red-700
                             text-sm font-medium">
                    Absent
                </span>

            @else

                <span class="px-3 py-1 rounded-full
                             bg-gray-100 dark:bg-gray-700
                             text-sm text-gray-600 dark:text-gray-300">
                    {{ ucfirst($attendance->status) }}
                </span>

            @endif

        @else

            <span class="px-3 py-1 rounded-full
                         bg-gray-100 dark:bg-gray-700
                         text-sm text-gray-600 dark:text-gray-300">
                Not Yet
            </span>

        @endif

    </div>

@empty

    <div class="bg-white dark:bg-gray-800 rounded-xl p-8 text-center">

        <div class="text-4xl mb-3">
            👨‍🎓
        </div>

        <p class="font-semibold text-gray-900 dark:text-white">
            No Students
        </p>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            There are no students registered in this class yet.
        </p>

    </div>

@endforelse

</div>


                <!-- Notes -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-6">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Lesson Notes
                    </h2>

                    <textarea
                        rows="4"
                        placeholder="Tuliskan catatan pembelajaran..."
                        class="mt-4 block w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                    ></textarea>

                </div>


                <!-- Submit -->
                <div class="flex justify-end">

                    <button
                        type="button"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-sm"
                    >
                        ✓ Submit Session
                    </button>

                </div>

            </main>

        </div>

    </div>

</x-app-layout>