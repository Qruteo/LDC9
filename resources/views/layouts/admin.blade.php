<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ClassSync - Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .sidebar {
            width: 245px;
            min-height: 100vh;
            background: white;
            border-right: 1px solid #e5e7eb;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .main-content {
            margin-left: 245px;
            min-height: 100vh;
            background: #f5f6f8;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 18px;
            margin: 4px 12px;
            border-radius: 9px;
            color: #374151;
            text-decoration: none;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #eff6ff;
            color: #2563eb;
        }

        .menu-item.active {
            background: #2563eb;
            color: white;
        }

        .menu-icon {
            width: 24px;
            text-align: center;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <!-- Logo -->
        <div class="px-5 py-6 border-b border-gray-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-blue-600
                            flex items-center justify-center
                            text-white font-bold text-lg">
                    C
                </div>

                <div>
                    <h1 class="text-xl font-bold text-blue-600">
                        ClassSync
                    </h1>

                    <p class="text-xs text-gray-500 mt-1">
                        Admin Panel
                    </p>
                </div>

            </div>

        </div>


        <!-- MENU -->
        <nav class="mt-5">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <span class="menu-icon">🏠</span>

                <span>Dashboard</span>

            </a>


            <!-- Data Siswa -->
            <a href="{{ route('admin.siswa') }}"
               class="menu-item {{ request()->routeIs('admin.siswa') ? 'active' : '' }}">

                <span class="menu-icon">👨‍🎓</span>

                <span>Data Siswa</span>

            </a>


            <!-- Data Guru -->
            <a href="{{ route('admin.guru') }}"
               class="menu-item {{ request()->routeIs('admin.guru') ? 'active' : '' }}">

                <span class="menu-icon">👩‍🏫</span>

                <span>Data Guru</span>

            </a>


            <!-- Data Kelas -->
            <a href="{{ route('admin.kelas') }}"
               class="menu-item {{ request()->routeIs('admin.kelas') ? 'active' : '' }}">

                <span class="menu-icon">🏫</span>

                <span>Data Kelas</span>

            </a>


            <!-- Mata Pelajaran -->
            <a href="{{ route('admin.mata-pelajaran') }}"
               class="menu-item {{ request()->routeIs('admin.mata-pelajaran') ? 'active' : '' }}">

                <span class="menu-icon">📚</span>

                <span>Mata Pelajaran</span>

            </a>


            <!-- Jadwal -->
            <a href="{{ route('admin.jadwal') }}"
               class="menu-item {{ request()->routeIs('admin.jadwal') ? 'active' : '' }}">

                <span class="menu-icon">🗓️</span>

                <span>Jadwal</span>

            </a>


            <!-- Rekap Absensi -->
            <a href="{{ route('admin.absensi') }}"
               class="menu-item {{ request()->routeIs('admin.absensi') ? 'active' : '' }}">

                <span class="menu-icon">📊</span>

                <span>Rekap Absensi</span>

            </a>

        </nav>

    </aside>



    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <header class="bg-white border-b border-gray-200">

            <div class="px-7 py-5 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-bold text-gray-900">
                        @yield('page-title', 'Dashboard Admin')
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Kelola sistem ClassSync
                    </p>

                </div>


                <!-- ADMIN -->
                <div class="flex items-center gap-3">

                    <div class="text-right">

                        <p class="font-semibold text-gray-800">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Administrator
                        </p>

                    </div>

                    <form method="POST" action="{{ route('logout') }}">
    @csrf

    <button
        type="submit"
        class="w-full text-left px-4 py-2 rounded-lg
               text-red-600 hover:bg-red-50">

        Logout

    </button>
</form>

                    <div class="w-11 h-11 rounded-full bg-blue-100
                                flex items-center justify-center
                                text-blue-600 font-bold">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                </div>

            </div>

        </header>


        <!-- PAGE -->
        <section class="p-7">

            @yield('content')

        </section>

    </main>


    @stack('scripts')

</body>
</html>