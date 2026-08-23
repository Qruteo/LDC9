@extends('layouts.admin')

@section('page-title', 'Data Guru')

@section('content')

<div>

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-2xl font-bold text-gray-900">
                Data Guru
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola data guru ClassSync.
            </p>

        </div>

        <a href="{{ route('admin.guru.create') }}"
           class="bg-blue-600 hover:bg-blue-700
                  text-white px-5 py-2.5 rounded-lg">

            + Tambah Guru

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

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b bg-gray-50">

                        <th class="text-left px-6 py-4 text-sm">
                            No
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Nama Guru
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

                    @forelse($teachers as $index => $teacher)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $teacher->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $teacher->email }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <a href="{{ route('admin.guru.edit', $teacher) }}"
                                       class="text-blue-600 hover:underline">

                                        Edit

                                    </a>


                                    <form method="POST"
                                          action="{{ route('admin.guru.destroy', $teacher) }}"
                                          onsubmit="return confirm('Hapus guru ini?')">

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

                            <td colspan="4"
                                class="text-center py-10 text-gray-500">

                                Belum ada data guru.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection