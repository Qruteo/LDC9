@extends('layouts.admin')

@section('page-title', 'Siswa Kelas')

@section('content')

<div>

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-2xl font-bold text-gray-900">
                Siswa Kelas {{ $classRoom->name }}
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola siswa yang terdaftar di kelas ini.
            </p>

        </div>

        <a href="{{ route('admin.kelas') }}"
           class="bg-gray-200 hover:bg-gray-300
                  text-gray-700 px-5 py-2.5 rounded-lg">

            ← Kembali

        </a>

    </div>


    @if(session('success'))

        <div class="mb-6 bg-green-50 border border-green-200
                    text-green-700 px-4 py-3 rounded-lg">

            {{ session('success') }}

        </div>

    @endif


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 overflow-hidden">

        <div class="px-6 py-4 border-b bg-gray-50">

            <h3 class="font-semibold text-gray-900">
                Daftar Siswa
            </h3>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b bg-gray-50">

                        <th class="text-left px-6 py-4 text-sm">
                            No
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Nama Siswa
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Email
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($students as $index => $student)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $student->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $student->email }}
                            </td>

                            <td class="px-6 py-4">

                                <form method="POST"
                                      action="{{ route(
                                          'admin.kelas.students.destroy',
                                          [$classRoom, $student]
                                      ) }}"
                                      onsubmit="return confirm('Keluarkan siswa ini dari kelas?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:underline">

                                        Keluarkan

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="text-center py-10 text-gray-500">

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