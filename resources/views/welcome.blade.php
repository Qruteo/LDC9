<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassSync - Classroom Management & Learning Record System</title>

    <!-- Font Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Warna Latar Belakang Persis 100% Seperti Halaman Login Attendfy */
        .bg-classsync {
            background-color: #BFDBFE !important;
        }

        /* Container Card Utama */
        .card-container {
            background: #ffffff;
            box-shadow: 0 15px 35px -5px rgba(37, 99, 235, 0.12);
        }

        /* Warna Biru Primary Tombol Login Attendfy */
        .btn-blue-classsync {
            background-color: #2563EB;
        }

        .btn-blue-classsync:hover {
            background-color: #1D4ED8;
        }
    </style>
</head>

<body class="bg-classsync min-h-screen flex items-center justify-center p-4 sm:p-6 antialiased">

    <!-- Main Card Container Compact -->
    <main
        class="w-full max-w-4xl card-container rounded-3xl p-6 sm:p-8 md:p-9 border border-white relative overflow-hidden">

        <!-- Header / Navigation Bar -->
        <header class="flex items-center justify-between pb-5 mb-7 border-b border-slate-100">
          <!-- Brand Logo ClassSync -->
<!-- Brand Logo ClassSync -->
<div class="flex items-center">
    <img
        src="{{ asset('images/classsync-logo.png') }}"
        alt="ClassSync Logo"
        class="w-20 h-20 object-contain"
    >

    <div class="ml-3">
        <p class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">
            Smart Attendance
        </p>
    </div>
</div>
</div>
           <!-- Auth Buttons -->
<div class="flex items-center gap-3">

    <!-- Login -->
    <a href="{{ route('login') }}"
        class="px-6 py-2.5 text-sm font-semibold text-slate-700
               bg-blue-50 hover:bg-blue-100 hover:text-blue-600
               rounded-xl transition-all duration-150
               active:scale-95">
        Login
    </a>

    <!-- Register -->
    <a href="{{ route('register') }}"
        class="px-7 py-2.5 text-sm font-semibold text-white
               bg-blue-600 hover:bg-blue-700
               rounded-xl shadow-md shadow-blue-500/20
               transition-all duration-150 active:scale-95">
        Register
    </a>

</div> 
        </header>

        <!-- Main Content Area Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

            <!-- Left Column: Copywriting Singkat -->
            <div class="md:col-span-6 space-y-4">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-blue-50 border border-blue-200 text-blue-600 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Sistem Absensi Digital
                </div>

                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                    Classroom Management & <span class="text-blue-600">Learning Record System</span>
                </h1>

                <p class="text-slate-500 text-xs sm:text-sm leading-relaxed">
                    Kelola presensi siswa, guru, dan rekap harian secara cepat, akurat, dan terintegrasi.
                </p>

                <!-- Poin Fitur Ringkas -->
                <div class="grid grid-cols-2 gap-3 pt-1">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-blue-600 font-bold text-xs sm:text-sm">QR Code System</p>
                        <p class="text-[11px] text-slate-400">Absen cepat & praktis</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-blue-600 font-bold text-xs sm:text-sm">Real-Time Data</p>
                        <p class="text-[11px] text-slate-400">Rekap otomatis</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visual Photo & Overlay -->
            <div class="md:col-span-6">
                <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-md group">
                    <!-- Foto Aktivitas Pembelajaran Alami -->
                    <img src="{{ asset('images/classroom.jpg') }}" alt="Kegiatan Belajar dan Presensi Kelas"
                        class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">


                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent">
                    </div>

                    <!-- Overlay Floating Badge -->
                    <div
                        class="absolute bottom-3.5 left-3.5 right-3.5 bg-white/95 backdrop-blur-md p-3 rounded-xl border border-white/80 shadow-md flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 btn-blue-attendfy text-white rounded-lg flex items-center justify-center font-bold text-xs shadow-sm">
                                QR
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Presensi
                                    Digital</p>
                                <p class="text-xs font-bold text-slate-800">Siswa & Guru Terintegrasi</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-semibold px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-md">
                            Active
                        </span>
                    </div>
                </div>
            </div>

        </div>

    </main>

</body>

</html>