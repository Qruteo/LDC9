<aside class="w-64 bg-white border-r border-gray-200 min-h-screen flex flex-col">

    {{-- Logo --}}
    <div class="h-20 flex items-center px-6 border-b border-gray-200">
        <div class="w-11 h-11 rounded-full bg-blue-600 flex items-center justify-center text-white text-2xl">
            ✓
        </div>

        <span class="ml-3 text-xl font-bold text-blue-600">
            Attendfy
        </span>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-3 py-4 space-y-2">

        {{-- Dashboard --}}
        <a href="{{ route('teacher.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('teacher.dashboard')
                ? 'bg-blue-600 text-white'
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-xl">🏠</span>
            <span>Dashboard</span>
        </a>


        {{-- Scan QR --}}
        <a href="{{ route('teacher.scan') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('teacher.scan')
                ? 'bg-blue-600 text-white'
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-xl">📷</span>
            <span>Scan Class QR</span>
        </a>


        {{-- My Sessions --}}
        <a href="{{ route('teacher.current') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('teacher.current')
                ? 'bg-blue-600 text-white'
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-xl">📚</span>
            <span>My Sessions</span>
        </a>


        {{-- My Attendance --}}
        <a href="{{ route('teacher.attendance') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('teacher.attendance')
                ? 'bg-blue-600 text-white'
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-xl">🕘</span>
            <span>My Attendance</span>
        </a>


        {{-- Schedule --}}
        <a href="{{ route('teacher.schedule') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('teacher.schedule')
                ? 'bg-blue-600 text-white'
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-xl">🗓️</span>
            <span>Schedule</span>
        </a>


        {{-- Session History --}}
        <a href="{{ route('teacher.sessions') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('teacher.sessions')
                ? 'bg-blue-600 text-white'
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-xl">📜</span>
            <span>Session History</span>
        </a>


        {{-- Profile --}}
        <a href="{{ route('teacher.profile') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg
           {{ request()->routeIs('teacher.profile')
                ? 'bg-blue-600 text-white'
                : 'text-gray-700 hover:bg-gray-100' }}">

            <span class="text-xl">👤</span>
            <span>Profile</span>
        </a>

    </nav>

</aside>