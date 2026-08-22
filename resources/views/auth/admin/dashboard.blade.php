@extends('layouts.admin')

@section('page-title', 'Dashboard Admin')

@section('content')

    <!-- Welcome -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600
                rounded-2xl p-7 text-white shadow-lg mb-7">

        <h1 class="text-3xl font-bold">
            Selamat Datang, {{ Auth::user()->name }} 👋
        </h1>

        <p class="mt-2 text-blue-100">
            Kelola seluruh data ClassSync melalui dashboard admin.
        </p>

    </div>


    <!-- STATISTICS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-7">

        <!-- Siswa -->
        <div class="bg-white rounded-xl border border-gray-100
                    shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Siswa
                    </p>

                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        0
                    </h3>

                    <p class="text-xs text-green-600 mt-2">
                        Data siswa terdaftar
                    </p>

                </div>

                <div class="w-12 h-12 rounded-xl bg-blue-100
                            flex items-center justify-center text-2xl">
                    👨‍🎓
                </div>

            </div>

        </div>


        <!-- Guru -->
        <div class="bg-white rounded-xl border border-gray-100
                    shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Guru
                    </p>

                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        0
                    </h3>

                    <p class="text-xs text-green-600 mt-2">
                        Guru aktif
                    </p>

                </div>

                <div class="w-12 h-12 rounded-xl bg-green-100
                            flex items-center justify-center text-2xl">
                    👩‍🏫
                </div>

            </div>

        </div>


        <!-- Kelas -->
        <div class="bg-white rounded-xl border border-gray-100
                    shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Kelas
                    </p>

                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        0
                    </h3>

                    <p class="text-xs text-green-600 mt-2">
                        Kelas aktif
                    </p>

                </div>

                <div class="w-12 h-12 rounded-xl bg-purple-100
                            flex items-center justify-center text-2xl">
                    🏫
                </div>

            </div>

        </div>


        <!-- Mata Pelajaran -->
        <div class="bg-white rounded-xl border border-gray-100
                    shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Mata Pelajaran
                    </p>

                    <h3 class="text-3xl font-bold text-gray-900 mt-2">
                        0
                    </h3>

                    <p class="text-xs text-green-600 mt-2">
                        Mata pelajaran tersedia
                    </p>

                </div>

                <div class="w-12 h-12 rounded-xl bg-yellow-100
                            flex items-center justify-center text-2xl">
                    📚
                </div>

            </div>

        </div>

    </div>


    <!-- MENU ADMINISTRASI -->
    <div class="bg-white rounded-xl border border-gray-100
                shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-xl font-bold text-gray-900">
                Menu Administrasi
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Kelola data utama sistem ClassSync.
            </p>

        </div>


        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">


                <!-- Siswa -->
                <a href="{{ route('admin.siswa') }}"
                   class="border border-gray-200 rounded-xl p-5
                          hover:border-blue-500 hover:shadow-md
                          transition">

                    <div class="text-3xl mb-3">
                        👨‍🎓
                    </div>

                    <h3 class="font-semibold text-gray-900">
                        Data Siswa
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data siswa
                    </p>

                </a>


                <!-- Guru -->
                <a href="{{ route('admin.guru') }}"
                   class="border border-gray-200 rounded-xl p-5
                          hover:border-blue-500 hover:shadow-md
                          transition">

                    <div class="text-3xl mb-3">
                        👩‍🏫
                    </div>

                    <h3 class="font-semibold text-gray-900">
                        Data Guru
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data guru
                    </p>

                </a>


                <!-- Kelas -->
                <a href="{{ route('admin.kelas') }}"
                   class="border border-gray-200 rounded-xl p-5
                          hover:border-blue-500 hover:shadow-md
                          transition">

                    <div class="text-3xl mb-3">
                        🏫
                    </div>

                    <h3 class="font-semibold text-gray-900">
                        Data Kelas
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola data kelas
                    </p>

                </a>


                <!-- Mata Pelajaran -->
                <a href="{{ route('admin.mata-pelajaran') }}"
                   class="border border-gray-200 rounded-xl p-5
                          hover:border-blue-500 hover:shadow-md
                          transition">

                    <div class="text-3xl mb-3">
                        📚
                    </div>

                    <h3 class="font-semibold text-gray-900">
                        Mata Pelajaran
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola mata pelajaran
                    </p>

                </a>


                <!-- Jadwal -->
                <a href="{{ route('admin.jadwal') }}"
                   class="border border-gray-200 rounded-xl p-5
                          hover:border-blue-500 hover:shadow-md
                          transition">

                    <div class="text-3xl mb-3">
                        🗓️
                    </div>

                    <h3 class="font-semibold text-gray-900">
                        Jadwal
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola jadwal pelajaran
                    </p>

                </a>


                <!-- Absensi -->
                <a href="{{ route('admin.absensi') }}"
                   class="border border-gray-200 rounded-xl p-5
                          hover:border-blue-500 hover:shadow-md
                          transition">

                    <div class="text-3xl mb-3">
                        📊
                    </div>

                    <h3 class="font-semibold text-gray-900">
                        Rekap Absensi
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Lihat rekap kehadiran
                    </p>

                </a>

            </div>

        </div>

    </div>

@endsection