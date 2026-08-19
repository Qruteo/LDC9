<x-app-layout>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 p-8">

        <div class="max-w-5xl mx-auto">
            
@if(session('success'))
    <div class="mb-6 rounded-lg bg-green-100 border border-green-300 px-4 py-3 text-green-700">
        ✓ {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 rounded-lg bg-red-100 border border-red-300 px-4 py-3 text-red-700">
        {{ session('error') }}
    </div>
@endif
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Student Dashboard 👋
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Welcome, {{ Auth::user()->name }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Active Class Session
                </h2>

                <div class="mt-6 space-y-4">

                    @forelse($sessions as $session)

                        <div class="border dark:border-gray-700 rounded-xl p-5">

                            <div class="flex items-center justify-between">

                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                        {{ $session->schedule->classRoom->name }}
                                    </h3>

                                    <p class="text-gray-500 dark:text-gray-400">
                                        {{ $session->schedule->subject->name }}
                                    </p>

                                    <p class="text-sm text-gray-400 mt-2">
                                        Teacher: {{ $session->teacher->user->name }}
                                    </p>
                                </div>

                                <form
                                    method="POST"
                                    action="{{ route('student.attendance.store', $session) }}"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="px-5 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700"
                                    >
                                        ✓ Saya Hadir
                                    </button>

                                </form>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-10">

                            <div class="text-4xl">
                                📅
                            </div>

                            <p class="mt-3 font-semibold text-gray-900 dark:text-white">
                                Tidak ada kelas aktif
                            </p>

                            <p class="mt-1 text-gray-500">
                                Belum ada sesi kelas yang sedang berlangsung.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>