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
