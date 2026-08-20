<x-app-layout>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <div class="flex">

            <!-- =========================
                 SIDEBAR
            ========================== -->

            <aside class="w-64 min-h-screen bg-white dark:bg-gray-800 shadow-md">

                <!-- Logo -->
                <div class="p-6 border-b dark:border-gray-700">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 bg-blue-600 rounded-full
                                    flex items-center justify-center">

                            <span class="text-white font-bold text-lg">
                                C
                            </span>

                        </div>

                        <span class="text-xl font-bold text-blue-600">
                            ClassSync
                        </span>

                    </div>

                    <p class="text-xs text-gray-500 mt-2">
                        Admin Panel
                    </p>

                </div>


                <!-- Navigation -->
                <nav class="p-4 space-y-2">

                    <!-- Dashboard -->
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg
                              bg-blue-600 text-white">

                        <span class="text-lg">🏠</span>

                        <span class="font-medium">
                            Dashboard
                        </span>

                    </a>


                    <!-- Data Siswa -->
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg
                              text-gray-700 dark:text-gray-300
                              hover:bg-blue-50 dark:hover:bg-gray-700
                              transition">

                        <span class="text-lg">👨‍🎓</span>

                        <span>
                            Data Siswa
                        </span>

                    </a>


                    <!-- Data Guru -->
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg
                              text-gray-700 dark:text-gray-300
                              hover:bg-blue-50 dark:hover:bg-gray-700
                              transition">

                        <span class="text-lg">👨‍🏫</span>

                        <span>
                            Data Guru
                        </span>

                    </a>


                    <!-- Data Kelas -->
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg
                              text-gray-700 dark:text-gray-300
                              hover:bg-blue-50 dark:hover:bg-gray-700
                              transition">

                        <span class="text-lg">🏫</span>

                        <span>
                            Data Kelas
                        </span>

                    </a>


                    <!-- Mata Pelajaran -->
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg
                              text-gray-700 dark:text-gray-300
                              hover:bg-blue-50 dark:hover:bg-gray-700
                              transition">

                        <span class="text-lg">📚</span>

                        <span>
                            Mata Pelajaran
                        </span>

                    </a>


                    <!-- Jadwal -->
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg
                              text-gray-700 dark:text-gray-300
                              hover:bg-blue-50 dark:hover:bg-gray-700
                              transition">

                        <span class="text-lg">📅</span>

                        <span>
                            Jadwal
                        </span>

                    </a>


                    <!-- Rekap Absensi -->
                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg
                              text-gray-700 dark:text-gray-300
                              hover:bg-blue-50 dark:hover:bg-gray-700
                              transition">

                        <span class="text-lg">📊</span>

                        <span>
                            Rekap Absensi
                        </span>

                    </a>

                </nav>

            </aside>


            <!-- =========================
                 MAIN CONTENT
            ========================== -->

            <main class="flex-1">


                <!-- =========================
                     HEADER
                ========================== -->

                <header class="bg-white dark:bg-gray-800
                               border-b dark:border-gray-700">

                    <div class="px-8 py-4
                                flex items-center justify-between">

                        <div>

                            <h2 class="text-xl font-semibold
                                       text-gray-800 dark:text-white">

                                Dashboard Admin

                            </h2>

                            <p class="text-sm text-gray-500">

                                Kelola sistem ClassSync

                            </p>

                        </div>


                        <!-- Admin Profile -->

                        <div class="flex items-center gap-4">

                            <button
                                class="relative p-2 text-gray-500
                                       hover:text-blue-600">

                                🔔

                                <span
                                    class="absolute top-1 right-1
                                           w-2 h-2 bg-red-500
                                           rounded-full">
                                </span>

                            </button>


                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10
                                            rounded-full
                                            bg-blue-100
                                            flex items-center
                                            justify-center">

                                    <span class="text-blue-600 font-bold">
                                        A
                                    </span>

                                </div>


                                <div class="hidden md:block">

                                    <p class="text-sm font-semibold
                                              text-gray-800
                                              dark:text-white">

                                        Administrator

                                    </p>

                                    <p class="text-xs text-gray-500">

                                        Admin

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </header>



                <!-- =========================
                     DASHBOARD CONTENT
                ========================== -->

                <div class="p-8">


                    <!-- Welcome -->

                    <div class="mb-8">

                        <h1 class="text-3xl font-bold
                                   text-gray-900 dark:text-white">

                            Selamat Datang, Admin 👋

                        </h1>

                        <p class="mt-2 text-gray-500">

                            Berikut ringkasan aktivitas sistem
                            ClassSync.

                        </p>

                    </div>



                    <!-- =========================
                         STATISTIC CARDS
                    ========================== -->

                    <div class="grid grid-cols-1
                                sm:grid-cols-2
                                lg:grid-cols-4
                                gap-6 mb-8">


                        <!-- Siswa -->

                        <div class="bg-white dark:bg-gray-800
                                    rounded-xl shadow-sm
                                    p-6">

                            <div class="flex items-center
                                        justify-between">

                                <div>

                                    <p class="text-sm
                                              text-gray-500">

                                        Total Siswa

                                    </p>

                                    <h3 class="text-3xl
                                               font-bold
                                               text-gray-800
                                               dark:text-white
                                               mt-2">

                                        120

                                    </h3>

                                </div>


                                <div class="w-12 h-12
                                            rounded-lg
                                            bg-blue-100
                                            flex items-center
                                            justify-center">

                                    <span class="text-2xl">
                                        👨‍🎓
                                    </span>

                                </div>

                            </div>

                            <p class="text-xs text-green-600 mt-4">
                                Data siswa terdaftar
                            </p>

                        </div>



                        <!-- Guru -->

                        <div class="bg-white dark:bg-gray-800
                                    rounded-xl shadow-sm
                                    p-6">

                            <div class="flex items-center
                                        justify-between">

                                <div>

                                    <p class="text-sm
                                              text-gray-500">

                                        Total Guru

                                    </p>

                                    <h3 class="text-3xl
                                               font-bold
                                               text-gray-800
                                               dark:text-white
                                               mt-2">

                                        15

                                    </h3>

                                </div>


                                <div class="w-12 h-12
                                            rounded-lg
                                            bg-purple-100
                                            flex items-center
                                            justify-center">

                                    <span class="text-2xl">
                                        👨‍🏫
                                    </span>

                                </div>

                            </div>

                            <p class="text-xs text-green-600 mt-4">
                                Guru aktif
                            </p>

                        </div>



                        <!-- Kelas -->

                        <div class="bg-white dark:bg-gray-800
                                    rounded-xl shadow-sm
                                    p-6">

                            <div class="flex items-center
                                        justify-between">

                                <div>

                                    <p class="text-sm
                                              text-gray-500">

                                        Total Kelas

                                    </p>

                                    <h3 class="text-3xl
                                               font-bold
                                               text-gray-800
                                               dark:text-white
                                               mt-2">

                                        8

                                    </h3>

                                </div>


                                <div class="w-12 h-12
                                            rounded-lg
                                            bg-green-100
                                            flex items-center
                                            justify-center">

                                    <span class="text-2xl">
                                        🏫
                                    </span>

                                </div>

                            </div>

                            <p class="text-xs text-green-600 mt-4">
                                Kelas aktif
                            </p>

                        </div>



                        <!-- Mata Pelajaran -->

                        <div class="bg-white dark:bg-gray-800
                                    rounded-xl shadow-sm
                                    p-6">

                            <div class="flex items-center
                                        justify-between">

                                <div>

                                    <p class="text-sm
                                              text-gray-500">

                                        Mata Pelajaran

                                    </p>

                                    <h3 class="text-3xl
                                               font-bold
                                               text-gray-800
                                               dark:text-white
                                               mt-2">

                                        12

                                    </h3>

                                </div>


                                <div class="w-12 h-12
                                            rounded-lg
                                            bg-yellow-100
                                            flex items-center
                                            justify-center">

                                    <span class="text-2xl">
                                        📚
                                    </span>

                                </div>

                            </div>

                            <p class="text-xs text-green-600 mt-4">
                                Mata pelajaran tersedia
                            </p>

                        </div>

                    </div>



                    <!-- =========================
                         ATTENDANCE SUMMARY
                    ========================== -->

                    <div class="grid grid-cols-1
                                lg:grid-cols-3
                                gap-6 mb-8">


                        <!-- Kehadiran -->

                        <div class="bg-white dark:bg-gray-800
                                    rounded-xl shadow-sm
                                    p-6">

                            <h3 class="text-lg font-semibold
                                       text-gray-800
                                       dark:text-white">

                                Kehadiran Hari Ini

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">

                                Ringkasan absensi siswa

                            </p>


                            <div class="mt-6 space-y-5">


                                <!-- Hadir -->

                                <div>

                                    <div class="flex justify-between
                                                mb-2">

                                        <span class="text-sm">
                                            Hadir
                                        </span>

                                        <span class="text-sm
                                                     font-semibold">
                                            85%
                                        </span>

                                    </div>

                                    <div class="w-full bg-gray-200
                                                rounded-full h-2">

                                        <div
                                            class="bg-green-500
                                                   h-2 rounded-full"
                                            style="width: 85%">
                                        </div>

                                    </div>

                                </div>


                                <!-- Terlambat -->

                                <div>

                                    <div class="flex justify-between
                                                mb-2">

                                        <span class="text-sm">
                                            Terlambat
                                        </span>

                                        <span class="text-sm
                                                     font-semibold">
                                            10%
                                        </span>

                                    </div>

                                    <div class="w-full bg-gray-200
                                                rounded-full h-2">

                                        <div
                                            class="bg-yellow-500
                                                   h-2 rounded-full"
                                            style="width: 10%">
                                        </div>

                                    </div>

                                </div>


                                <!-- Tidak Hadir -->

                                <div>

                                    <div class="flex justify-between
                                                mb-2">

                                        <span class="text-sm">
                                            Tidak Hadir
                                        </span>

                                        <span class="text-sm
                                                     font-semibold">
                                            5%
                                        </span>

                                    </div>

                                    <div class="w-full bg-gray-200
                                                rounded-full h-2">

                                        <div
                                            class="bg-red-500
                                                   h-2 rounded-full"
                                            style="width: 5%">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <!-- Quick Actions -->

                        <div class="bg-white dark:bg-gray-800
                                    rounded-xl shadow-sm
                                    p-6 lg:col-span-2">

                            <h3 class="text-lg font-semibold
                                       text-gray-800
                                       dark:text-white">

                                Quick Actions

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">

                                Akses cepat pengelolaan sistem

                            </p>


                            <div class="grid grid-cols-2
                                        md:grid-cols-4
                                        gap-4 mt-6">


                                <a href="#"
                                   class="p-4 rounded-lg
                                          border
                                          hover:border-blue-500
                                          hover:bg-blue-50
                                          transition text-center">

                                    <div class="text-2xl mb-2">
                                        👨‍🎓
                                    </div>

                                    <p class="text-sm font-medium">
                                        Tambah Siswa
                                    </p>

                                </a>


                                <a href="#"
                                   class="p-4 rounded-lg
                                          border
                                          hover:border-blue-500
                                          hover:bg-blue-50
                                          transition text-center">

                                    <div class="text-2xl mb-2">
                                        👨‍🏫
                                    </div>

                                    <p class="text-sm font-medium">
                                        Tambah Guru
                                    </p>

                                </a>


                                <a href="#"
                                   class="p-4 rounded-lg
                                          border
                                          hover:border-blue-500
                                          hover:bg-blue-50
                                          transition text-center">

                                    <div class="text-2xl mb-2">
                                        🏫
                                    </div>

                                    <p class="text-sm font-medium">
                                        Tambah Kelas
                                    </p>

                                </a>


                                <a href="#"
                                   class="p-4 rounded-lg
                                          border
                                          hover:border-blue-500
                                          hover:bg-blue-50
                                          transition text-center">

                                    <div class="text-2xl mb-2">
                                        📊
                                    </div>

                                    <p class="text-sm font-medium">
                                        Rekap Absensi
                                    </p>

                                </a>

                            </div>

                        </div>

                    </div>



                    <!-- =========================
                         RECENT ACTIVITY
                    ========================== -->

                    <div class="bg-white dark:bg-gray-800
                                rounded-xl shadow-sm
                                overflow-hidden">

                        <div class="p-6 border-b
                                    dark:border-gray-700">

                            <h3 class="text-lg font-semibold
                                       text-gray-800
                                       dark:text-white">

                                Aktivitas Terbaru

                            </h3>

                            <p class="text-sm text-gray-500 mt-1">

                                Aktivitas terbaru di ClassSync

                            </p>

                        </div>


                        <div class="divide-y
                                    dark:divide-gray-700">


                            <!-- Activity 1 -->

                            <div class="p-5 flex items-center
                                        gap-4">

                                <div class="w-10 h-10
                                            rounded-full
                                            bg-blue-100
                                            flex items-center
                                            justify-center">

                                    👨‍🎓

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm
                                              font-medium
                                              text-gray-800
                                              dark:text-white">

                                        Siswa baru ditambahkan

                                    </p>

                                    <p class="text-xs
                                              text-gray-500">

                                        Data siswa berhasil
                                        ditambahkan ke sistem.

                                    </p>

                                </div>

                                <span class="text-xs text-gray-400">

                                    10 menit lalu

                                </span>

                            </div>



                            <!-- Activity 2 -->

                            <div class="p-5 flex items-center
                                        gap-4">

                                <div class="w-10 h-10
                                            rounded-full
                                            bg-purple-100
                                            flex items-center
                                            justify-center">

                                    👨‍🏫

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm
                                              font-medium
                                              text-gray-800
                                              dark:text-white">

                                        Guru baru ditambahkan

                                    </p>

                                    <p class="text-xs
                                              text-gray-500">

                                        Data guru berhasil
                                        ditambahkan.

                                    </p>

                                </div>

                                <span class="text-xs text-gray-400">

                                    30 menit lalu

                                </span>

                            </div>



                            <!-- Activity 3 -->

                            <div class="p-5 flex items-center
                                        gap-4">

                                <div class="w-10 h-10
                                            rounded-full
                                            bg-green-100
                                            flex items-center
                                            justify-center">

                                    📊

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm
                                              font-medium
                                              text-gray-800
                                              dark:text-white">

                                        Rekap absensi diperbarui

                                    </p>

                                    <p class="text-xs
                                              text-gray-500">

                                        Data kehadiran siswa
                                        berhasil diperbarui.

                                    </p>

                                </div>

                                <span class="text-xs text-gray-400">

                                    1 jam lalu

                                </span>

                            </div>


                        </div>

                    </div>


                </div>

            </main>

        </div>

    </div>

</x-app-layout>