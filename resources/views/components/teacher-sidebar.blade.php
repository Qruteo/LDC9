<!-- TEACHER SIDEBAR -->

<aside class="w-60 min-h-screen bg-white dark:bg-gray-800
              border-r border-gray-200 dark:border-gray-700
              flex flex-col">

    <!-- Logo -->
    <div class="h-20 px-6 flex items-center
                border-b border-gray-200 dark:border-gray-700">

        <div class="w-11 h-11 bg-blue-600 rounded-full
                    flex items-center justify-center">

            <span class="text-white text-xl font-bold">
                ✓
            </span>

        </div>

        <span class="ml-3 text-xl font-bold text-blue-600">
            Attendfy
        </span>

    </div>


    <!-- Navigation -->
    <nav class="p-4 space-y-2 flex-1">

        <!-- Dashboard -->
        <a href="{{ route('teacher.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('teacher.dashboard')
                ? 'bg-blue-600 text-white font-semibold'
                : 'text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700' }}">

            <span class="text-lg">🏠</span>
            <span>Dashboard</span>

        </a>


        <!-- Scan Class QR -->
        <a href="{{ route('teacher.scan') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('teacher.scan*')
                ? 'bg-blue-600 text-white font-semibold'
                : 'text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700' }}">

            <span class="text-lg">📷</span>
            <span>Scan Class QR</span>

        </a>


        <!-- My Sessions -->
        <a href="{{ route('teacher.current') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('teacher.current')
                ? 'bg-blue-600 text-white font-semibold'
                : 'text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700' }}">

            <span class="text-lg">📚</span>
            <span>My Sessions</span>

        </a>


        <!-- My Attendance -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                  text-gray-700 dark:text-gray-300
                  hover:bg-blue-50 dark:hover:bg-gray-700">

            <span class="text-lg">🕐</span>
            <span>My Attendance</span>

        </a>


        <!-- Schedule -->
        <a href="#"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                  text-gray-700 dark:text-gray-300
                  hover:bg-blue-50 dark:hover:bg-gray-700">

            <span class="text-lg">📅</span>
            <span>Schedule</span>

        </a>


        <!-- Session History -->
        <a href="{{ route('teacher.sessions') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('teacher.sessions')
                ? 'bg-blue-600 text-white font-semibold'
                : 'text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700' }}">

            <span class="text-lg">📜</span>
            <span>Session History</span>

        </a>


        <!-- Profile -->
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition
           {{ request()->routeIs('profile.*')
                ? 'bg-blue-600 text-white font-semibold'
                : 'text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700' }}">

            <span class="text-lg">👤</span>
            <span>Profile</span>

        </a>

    </nav>

</aside>