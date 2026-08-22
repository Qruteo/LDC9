<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'ClassSync')
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui']
                    }
                }
            }
        }
    </script>

    <style>

        body {
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #f1f5f9;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #2563eb, #315bea);
            color: white;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.18);
        }

    </style>

    @stack('styles')

</head>


<body class="bg-slate-100 text-slate-800">

<div class="min-h-screen flex">


    <!-- ================================================= -->
    <!-- SIDEBAR -->
    <!-- ================================================= -->

    <aside
        class="fixed lg:static inset-y-0 left-0 z-50
               w-64 bg-white border-r border-slate-200
               transform -translate-x-full lg:translate-x-0
               transition-transform duration-300"
        id="sidebar">


        <!-- ================= LOGO ================= -->

        <div class="h-28 flex items-center px-5 border-b border-slate-200">

            <a
                href="{{ route('teacher.dashboard') }}"
                class="flex items-center">

                <img
                    src="{{ asset('images/classsync-logo.png') }}"
                    alt="ClassSync"
                    class="w-52 h-20 object-contain"
                >

            </a>

        </div>


        <!-- ================= NAVIGATION ================= -->

        <nav class="px-3 py-5 space-y-2">


            <!-- DASHBOARD -->

            <a
                href="{{ route('teacher.dashboard') }}"
                class="sidebar-link
                {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}
                flex items-center gap-4
                px-4 py-3 rounded-lg">

                <span class="text-xl">
                    🏠
                </span>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>


            <!-- SCAN QR -->

            <a
                href="{{ route('teacher.scan') }}"
                class="sidebar-link
                {{ request()->routeIs('teacher.scan') ? 'active' : '' }}
                flex items-center gap-4
                px-4 py-3 rounded-lg">

                <span class="text-xl">
                    📷
                </span>

                <span class="font-medium">
                    Scan Class QR
                </span>

            </a>


            <!-- MY SESSIONS -->

            <a
                href="{{ route('teacher.sessions') }}"
                class="sidebar-link
                {{ request()->routeIs('teacher.sessions', 'teacher.session') ? 'active' : '' }}
                flex items-center gap-4
                px-4 py-3 rounded-lg">

                <span class="text-xl">
                    📚
                </span>

                <span class="font-medium">
                    My Sessions
                </span>

            </a>


            <!-- ATTENDANCE -->

            <a
                href="{{ route('teacher.attendance') }}"
                class="sidebar-link
                {{ request()->routeIs('teacher.attendance') ? 'active' : '' }}
                flex items-center gap-4
                px-4 py-3 rounded-lg">

                <span class="text-xl">
                    🕘
                </span>

                <span class="font-medium">
                    My Attendance
                </span>

            </a>


            <!-- SCHEDULE -->

            <a
                href="{{ route('teacher.schedule') }}"
                class="sidebar-link
                {{ request()->routeIs('teacher.schedule') ? 'active' : '' }}
                flex items-center gap-4
                px-4 py-3 rounded-lg">

                <span class="text-xl">
                    📅
                </span>

                <span class="font-medium">
                    Schedule
                </span>

            </a>


            <!-- SESSION HISTORY -->

            <a
                href="{{ route('teacher.session-history') }}"
                class="sidebar-link
                {{ request()->routeIs('teacher.session-history') ? 'active' : '' }}
                flex items-center gap-4
                px-4 py-3 rounded-lg">

                <span class="text-xl">
                    📜
                </span>

                <span class="font-medium">
                    Session History
                </span>

            </a>


            <!-- PROFILE -->

            <a
                href="{{ route('teacher.profile') }}"
                class="sidebar-link
                {{ request()->routeIs('teacher.profile') ? 'active' : '' }}
                flex items-center gap-4
                px-4 py-3 rounded-lg">

                <span class="text-xl">
                    👤
                </span>

                <span class="font-medium">
                    Profile
                </span>

            </a>

        </nav>


        <!-- ================= LOGOUT ================= -->

        <div
            class="absolute bottom-0 left-0 right-0
                   p-4 border-t border-slate-200">

            <form
                method="POST"
                action="{{ route('logout') }}">

                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-4
                           px-4 py-3 rounded-lg
                           text-slate-600
                           hover:bg-red-50
                           hover:text-red-600
                           transition">

                    <span class="text-xl">
                        🚪
                    </span>

                    <span class="font-medium">
                        Logout
                    </span>

                </button>

            </form>

        </div>

    </aside>


    <!-- ================================================= -->
    <!-- MAIN -->
    <!-- ================================================= -->

    <div class="flex-1 min-w-0">


        <!-- ================= TOPBAR ================= -->

        <header
            class="h-16 bg-white
                   border-b border-slate-200
                   flex items-center
                   px-6 lg:px-8">


            <div class="flex items-center gap-4">


                <!-- MOBILE BUTTON -->

                <button
                    onclick="toggleSidebar()"
                    class="lg:hidden
                           w-10 h-10
                           rounded-lg
                           bg-slate-100
                           flex items-center
                           justify-center">

                    ☰

                </button>


                <!-- PAGE TITLE -->

                <span class="text-sm text-slate-500">

                    @yield('page-title', 'Dashboard')

                </span>

            </div>

        </header>


        <!-- ================= CONTENT ================= -->

        <main class="p-6 lg:p-8">

            @yield('content')

        </main>

    </div>

</div>


<!-- ================================================= -->
<!-- MOBILE SIDEBAR -->
<!-- ================================================= -->

<script>

    function toggleSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        sidebar.classList.toggle('-translate-x-full');

    }

</script>


@stack('scripts')

</body>

</html>