@extends('layouts.admin')

@section('page-title', 'Data Siswa')

@section('content')

<div>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-2xl font-bold text-gray-900">
                Data Siswa
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola data siswa ClassSync.
            </p>

        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700
                   text-white px-5 py-2.5 rounded-lg
                   transition">

            + Tambah Siswa

        </button>

    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 overflow-hidden">

        <div class="p-6">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b bg-gray-50">

                            <th class="text-left px-4 py-3 text-sm">
                                No
                            </th>

                            <th class="text-left px-4 py-3 text-sm">
                                Nama
                            </th>

                            <th class="text-left px-4 py-3 text-sm">
                                NIS
                            </th>

                            <th class="text-left px-4 py-3 text-sm">
                                Kelas
                            </th>

                            <th class="text-left px-4 py-3 text-sm">
                                Jenis Kelamin
                            </th>

                            <th class="text-left px-4 py-3 text-sm">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td colspan="6"
                                class="text-center py-10 text-gray-500">

                                Belum ada data siswa.

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection