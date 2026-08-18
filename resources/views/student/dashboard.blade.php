<x-app-layout>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 p-8">

        <div class="max-w-5xl mx-auto">

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Welcome, {{ $student->name }} 👋
            </h1>

            <p class="mt-2 text-gray-500 dark:text-gray-400">
                Student Dashboard
            </p>

            <div class="mt-8">

                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    My Class
                </h2>

                <div class="mt-4 space-y-4">

                    @forelse($classes as $class)

                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ $class->name }}
                            </h3>

                            <p class="text-gray-500 dark:text-gray-400">
                                📍 {{ $class->room }}
                            </p>

                        </div>

                    @empty

                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6">
                            <p class="text-gray-500">
                                You are not assigned to a class yet.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>