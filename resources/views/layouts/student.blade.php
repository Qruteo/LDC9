<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard | ClassSync')</title>

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
        .nav-link {
            transition: all 0.2s ease;
        }
        .nav-link:hover {
            background-color: #f1f5f9;
        }
        .nav-link.active {
            background: linear-gradient(135deg, #2563eb, #315bea);
            color: white;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.18);
        }
        .nav-link.active span {
            color: white;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100 text-slate-800">

<div class="min-h-screen flex">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside id="sidebar"
           class="fixed lg:static inset-y-0 left-0 z-50
                  w-64 bg-white border-r border-slate-200
                  transform -translate-x-full lg:translate-x-0
                  transition-transform duration-300
                  flex flex-col">

        {{-- LOGO --}}
        <div class="h-20 flex items-center px-5 border-b border-slate-200 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-black text-base shadow-md shadow-blue-500/20">
                    CS
                </div>
                <div>
                    <p class="font-extrabold text-sm text-slate-900 leading-none">ClassSync</p>
                    <p class="text-[10px] font-semibold text-blue-600 uppercase tracking-wider mt-0.5">Student Portal</p>
                </div>
            </div>
        </div>

        {{-- USER BRIEF --}}
        <div class="p-4 shrink-0">
            <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 rounded-xl p-3">
                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shrink-0">
                    {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-900 truncate leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Siswa</p>
                </div>
            </div>
        </div>

        {{-- NAV --}}
        <nav class="flex-1 px-3 space-y-1 pb-4">
            <a href="{{ route('student.dashboard') }}"
               class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : 'text-slate-600' }}
                      flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold">
                <span class="text-lg">📊</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('profile.edit') }}"
               class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : 'text-slate-600' }}
                      flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold">
                <span class="text-lg">👤</span>
                <span>Profil Saya</span>
            </a>
        </nav>

        {{-- LOGOUT --}}
        <div class="p-4 border-t border-slate-100 shrink-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-rose-600 hover:bg-rose-50 transition">
                    <span class="text-lg">🚪</span>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>


    {{-- ===================== MAIN CONTENT ===================== --}}
    <div class="flex-1 flex flex-col min-w-0 lg:min-h-screen">

        {{-- TOPBAR --}}
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-30 shrink-0">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                    ☰
                </button>
                <span class="text-sm font-semibold text-slate-500">
                    @yield('page-title', 'Dashboard')
                </span>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Siswa Aktif
            </span>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

</div>

{{-- MOBILE OVERLAY --}}
<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/30 z-40 hidden lg:hidden"
     onclick="toggleSidebar()">
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>

@stack('scripts')

</body>
</html>
