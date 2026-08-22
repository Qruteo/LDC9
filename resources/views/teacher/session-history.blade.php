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