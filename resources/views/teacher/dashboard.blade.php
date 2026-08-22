<x-app-layout>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <div class="flex">

            <x-teacher-sidebar />



            <!-- Main Content -->
            <main class="flex-1 p-8">

                <!-- Header -->
                <div class="flex items-center justify-between mb-8">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            Good morning, {{ $teacher->user->name }} 👋
                        </h1>

                        <p class="mt-1 text-gray-500 dark:text-gray-400">
                            Welcome back to your teaching dashboard.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">

                        <div class="text-right">
                            <p class="font-semibold text-gray-900 dark:text-white">
                                {{ $teacher->user->name }}
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

                @if($activeSessions->count() > 0)

                    <section class="mb-8">

                        <div class="flex items-center justify-between mb-4">

                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                    Current Session
                                </h2>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Your active teaching session
                                </p>
                            </div>

                        </div>

                        <div class="space-y-4">

                            @foreach($activeSessions as $session)

                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                                    <div class="flex items-center justify-between">

                                        <div>

                                            <div class="flex items-center gap-3">

                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                    {{ $session->schedule->classRoom->name }}
                                                </h3>

                                                <span
                                                    class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                                    Ongoing
                                                </span>

                                            </div>

                                            <p class="mt-1 text-gray-500 dark:text-gray-400">
                                                {{ $session->schedule->subject->name }}
                                            </p>

                                            <p class="mt-1 text-sm text-gray-400">
                                                📍 {{ $session->schedule->classRoom->room }}
                                            </p>

                                        </div>

                                        <a href="{{ route('teacher.session') }}?session={{ $session->id }}"
                                            class="px-5 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                                            📚 Open Session
                                        </a>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </section>

                @endif


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

                                                <form method="POST" action="{{ route('teacher.session.start', $schedule->id) }}"
                                                    class="mt-3">
                                                    @csrf

                                                    <button type="submit"
                                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                                                        Start Session
                                                    </button>
                                                </form>

                                                <p class="text-sm text-gray-400">
                                                    🕐
                                                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                                </p>

                                            </div>

                                        </div>

                                        <a href="{{ route('teacher.scan') }}"
                                            class="px-5 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
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
