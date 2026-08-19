<x-app-layout>

```
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <div class="flex">

       <x-teacher-sidebar />


        <!-- =========================
             CONTENT
        ========================== -->
        <main class="flex-1 p-8">

        <div class="flex items-center justify-between mb-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-900">
            Session Detail
        </h1>

        <p class="mt-2 text-gray-500">
            Detail kehadiran siswa pada session ini.
        </p>

    </div>


    <div class="flex items-center gap-3">

        <!-- Back -->
        <a href="{{ route('teacher.sessions') }}"
           class="inline-flex items-center gap-2
                  px-4 py-2
                  bg-gray-200 text-gray-700
                  rounded-lg
                  hover:bg-gray-300
                  transition">

            ← Back

        </a>


        <!-- Export -->
        <a href="{{ route('teacher.session.export', $classSession->id) }}"
           class="inline-flex items-center gap-2
                  px-4 py-2
                  bg-green-600 text-white
                  rounded-lg
                  hover:bg-green-700
                  transition">

            📊 Export Excel

        </a>

    </div>

</div>

            <!-- Header -->
            <div class="mb-8">

                <div class="flex items-center justify-between">

                    <div>

                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Current Session
                        </h1>

                        <p class="mt-2 text-gray-500">
                            Session yang sedang berlangsung.
                        </p>

                    </div>


                    <a href="{{ route('teacher.dashboard') }}"
                       class="px-4 py-2 bg-gray-200 rounded-lg
                              text-gray-700 hover:bg-gray-300">

                        ← Back to Dashboard

                    </a>

                </div>

            </div>


            <!-- =========================
                 SESSION INFORMATION
            ========================== -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8">

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ $classSession->schedule->classRoom->name }}
                        </h2>

                        <p class="text-gray-500 mt-1">
                            {{ $classSession->schedule->subject->name }}
                        </p>

                    </div>


                    @if($classSession->status === 'ongoing')

                        <span class="px-4 py-2 rounded-full
                                     text-sm font-semibold
                                     bg-green-100 text-green-700">

                            ● Ongoing

                        </span>

                    @else

                        <span class="px-4 py-2 rounded-full
                                     text-sm font-semibold
                                     bg-gray-100 text-gray-700">

                            {{ ucfirst($classSession->status) }}

                        </span>

                    @endif

                </div>


                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    <!-- Class -->
                    <div>

                        <p class="text-sm text-gray-500">
                            Class
                        </p>

                        <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">
                            {{ $classSession->schedule->classRoom->name }}
                        </p>

                    </div>


                    <!-- Subject -->
                    <div>

                        <p class="text-sm text-gray-500">
                            Subject
                        </p>

                        <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">
                            {{ $classSession->schedule->subject->name }}
                        </p>

                    </div>


                    <!-- Date -->
                    <div>

                        <p class="text-sm text-gray-500">
                            Date
                        </p>

                        <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">

                            {{ \Carbon\Carbon::parse($classSession->session_date)->format('d M Y') }}

                        </p>

                    </div>


                    <!-- Start -->
                    <div>

                        <p class="text-sm text-gray-500">
                            Start
                        </p>

                        <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">

                            {{ \Carbon\Carbon::parse($classSession->start_time)->format('H:i') }}

                        </p>

                    </div>

                </div>

            </div>


            <!-- =========================
                 STUDENT ATTENDANCE
            ========================== -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">

                <div class="p-6 border-b dark:border-gray-700">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Student Attendance
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Daftar siswa pada session ini.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 dark:bg-gray-700">

                            <tr>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Student
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y dark:divide-gray-700">

                            @forelse($students as $index => $student)

                                @php

                                    $attendance = $classSession->attendances
                                        ->where('student_id', $student->id)
                                        ->first();

                                @endphp


                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">

                                    <td class="px-6 py-4">
                                        {{ $index + 1 }}
                                    </td>


                                    <td class="px-6 py-4 font-medium">

                                        {{ $student->name }}

                                    </td>


                                    <td class="px-6 py-4">

                                        @if($attendance)

                                            <span class="px-3 py-1 rounded-full
                                                         text-xs font-semibold
                                                         bg-green-100 text-green-700">

                                                {{ ucfirst($attendance->status) }}

                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full
                                                         text-xs font-semibold
                                                         bg-gray-100 text-gray-700">

                                                Belum Absen

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3"
                                        class="px-6 py-10 text-center text-gray-500">

                                        Belum ada siswa di kelas ini.

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
