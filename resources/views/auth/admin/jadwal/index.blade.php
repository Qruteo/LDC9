@extends('layouts.admin')

@section('page-title', 'Jadwal')

@section('content')

<div>

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Jadwal Pelajaran
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola jadwal kelas, guru, dan mata pelajaran ClassSync.
            </p>
        </div>

        <a href="{{ route('admin.jadwal.create') }}"
           class="bg-blue-600 hover:bg-blue-700
                  text-white px-5 py-2.5 rounded-lg">

            + Tambah Jadwal

        </a>

    </div>


    @if(session('success'))

        <div class="mb-6 bg-green-50 border border-green-200
                    text-green-700 px-4 py-3 rounded-lg">

            {{ session('success') }}

        </div>

    @endif


    @if($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">

            <ul class="list-disc list-inside">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b bg-gray-50">

                        <th class="text-left px-6 py-4 text-sm">
                            No
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Hari
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Jam
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Kelas
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Mata Pelajaran
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Guru
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($schedules as $index => $schedule)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $schedule->day }}
                            </td>

                            <td class="px-6 py-4">

                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}

                                -

                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}

                            </td>

                            <td class="px-6 py-4">
                                {{ $schedule->classRoom->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $schedule->subject->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $schedule->teacher->user->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <a href="{{ route('admin.jadwal.edit', $schedule) }}"
                                       class="text-blue-600 hover:underline">

                                        Edit

                                    </a>


                                    <form method="POST"
                                          action="{{ route('admin.jadwal.destroy', $schedule) }}"
                                          onsubmit="return confirm('Hapus jadwal ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 hover:underline">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-10 text-gray-500">

                                Belum ada jadwal.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection