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

                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white">
                        <span>🏠</span>
                        <span>Dashboard</span>
                    </a>

                   <a
    href="{{ route('teacher.scan') }}"
    class="inline-flex items-center px-5 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition"
>
    📷 Scan Class QR
</a>
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">
                        <span>📚</span>
                        <span>My Sessions</span>
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
                <div class="flex items-center justify-between mb-8">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Good morning, Pak Budi 👋
                        </h1>

                        <p class="mt-1 text-gray-500 dark:text-gray-400">
                            Welcome back to your teaching dashboard.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">

                        <div class="text-right">
                            <p class="font-semibold text-gray-900 dark:text-white">
                                Pak Budi
                            </p>

                            <p class="text-sm text-gray-500">
                                Teacher
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-full bg-blue-600 flex items-center justify-center">
                            <span class="text-white font-bold">
                                B
                            </span>
                        </div>

                    </div>

                </div>


                <!-- Today's Schedule -->
                <section>

                    <div class="flex items-center justify-between mb-4">

                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                Today's Schedule
                            </h2>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Your teaching schedule for today
                            </p>
                        </div>

                    </div>


                    <!-- Schedule Cards -->

@if($schedules->count() > 0)

    <div class="space-y-4">

        @foreach($schedules as $schedule)

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-5">

                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Start
                            </p>
                        </div>

                        <div class="h-12 w-px bg-gray-200 dark:bg-gray-700"></div>

                        <div>

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $schedule->classRoom->name }}
                            </h3>

                            <p class="text-gray-500 dark:text-gray-400">
                                {{ $schedule->subject->name }}
                            </p>

                            <p class="text-sm text-gray-400 mt-1">
                                📍 {{ $schedule->classRoom->room }}
                            </p>

                            <p class="text-sm text-gray-400">
                                🕐
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                            </p>

                        </div>

                    </div>

                    <a
                        href="{{ route('teacher.scan') }}"
                        class="px-5 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition"
                    >
                        📷 Scan Class QR
                    </a>

                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-8 text-center">

        <div class="text-4xl mb-3">
            📅
        </div>

        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
            No Schedule
        </h3>

        <p class="mt-2 text-gray-500 dark:text-gray-400">
            You don't have any teaching schedule yet.
        </p>

    </div>

@endif


                </section>

            </main>

        </div>

    </div>

</x-app-layout>