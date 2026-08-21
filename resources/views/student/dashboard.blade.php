<x-app-layout>

    <div class="min-h-screen bg-slate-100">

        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-8">

            {{-- ================= ALERT ================= --}}

            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl
                            bg-green-50 border border-green-200
                            px-5 py-4 text-green-700 shadow-sm">

                    <div class="w-9 h-9 rounded-full bg-green-100
                                flex items-center justify-center text-lg">
                        ✓
                    </div>

                    <div>
                        <p class="font-semibold">Berhasil</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>

                </div>
            @endif


            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 rounded-xl
                            bg-red-50 border border-red-200
                            px-5 py-4 text-red-700 shadow-sm">

                    <div class="w-9 h-9 rounded-full bg-red-100
                                flex items-center justify-center text-lg">
                        !
                    </div>

                    <div>
                        <p class="font-semibold">Gagal</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>

                </div>
            @endif


            {{-- ================= HEADER ================= --}}

            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between
                        gap-5 mb-8">

                <div>

                    <div class="flex items-center gap-3">

                        <h1 class="text-3xl sm:text-4xl
                                   font-bold text-slate-900">

                            Student Dashboard

                        </h1>

                        <span class="text-3xl">
                            👋
                        </span>

                    </div>

                    <p class="mt-2 text-slate-500">
                        Selamat datang kembali,
                        <span class="font-semibold text-slate-700">
                            {{ Auth::user()->name }}
                        </span>
                    </p>

                </div>


                {{-- USER CARD --}}

                <div class="flex items-center gap-3
                            bg-white rounded-xl
                            border border-slate-200
                            px-4 py-3 shadow-sm">

                    <div class="w-11 h-11 rounded-full
                                bg-blue-600 text-white
                                flex items-center justify-center
                                font-bold text-lg">

                        {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 1)) }}

                    </div>

                    <div>

                        <p class="font-semibold text-slate-800">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            Student
                        </p>

                    </div>

                </div>

            </div>


            {{-- ================= WELCOME CARD ================= --}}

            <div class="relative overflow-hidden
                        rounded-2xl
                        bg-gradient-to-r from-blue-600 to-indigo-600
                        text-white
                        p-7 sm:p-8
                        mb-8
                        shadow-lg">

                {{-- Decorative circle --}}

                <div class="absolute -right-10 -top-10
                            w-40 h-40
                            bg-white/10
                            rounded-full">
                </div>

                <div class="absolute right-20 -bottom-16
                            w-32 h-32
                            bg-white/10
                            rounded-full">
                </div>


                <div class="relative">

                    <p class="text-blue-100 text-sm mb-2">
                        CLASSYNC STUDENT
                    </p>

                    <h2 class="text-2xl sm:text-3xl
                               font-bold">

                        Ready for today's class?

                    </h2>

                    <p class="mt-2 text-blue-100
                              max-w-xl">

                        Lihat kelas yang sedang berlangsung
                        dan lakukan absensi dengan mudah.

                    </p>

                </div>

            </div>


            {{-- ================= STATISTICS ================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-3
                        gap-5 mb-8">


                {{-- ACTIVE CLASS --}}

                <div class="bg-white rounded-2xl
                            border border-slate-200
                            p-5 shadow-sm">

                    <div class="flex items-center
                                justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Active Classes
                            </p>

                            <p class="mt-1 text-3xl
                                      font-bold text-slate-900">

                                {{ $sessions->count() }}

                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl
                                    bg-blue-100
                                    flex items-center justify-center
                                    text-2xl">

                            📚

                        </div>

                    </div>

                </div>


                {{-- TODAY --}}

                <div class="bg-white rounded-2xl
                            border border-slate-200
                            p-5 shadow-sm">

                    <div class="flex items-center
                                justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Attendance
                            </p>

                            <p class="mt-1 text-lg
                                      font-bold text-slate-900">

                                Today's Class

                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl
                                    bg-green-100
                                    flex items-center justify-center
                                    text-2xl">

                            ✓

                        </div>

                    </div>

                </div>


                {{-- STATUS --}}

                <div class="bg-white rounded-2xl
                            border border-slate-200
                            p-5 shadow-sm">

                    <div class="flex items-center
                                justify-between">

                        <div>

                            <p class="text-sm text-slate-500">
                                Status
                            </p>

                            <p class="mt-1 text-lg
                                      font-bold text-green-600">

                                Active

                            </p>

                        </div>

                        <div class="w-12 h-12 rounded-xl
                                    bg-green-100
                                    flex items-center justify-center
                                    text-2xl">

                            🟢

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================= ACTIVE SESSION ================= --}}

            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm overflow-hidden">


                {{-- HEADER --}}

                <div class="px-6 sm:px-7 py-6
                            border-b border-slate-100">

                    <div class="flex items-center
                                justify-between gap-4">

                        <div>

                            <h2 class="text-xl sm:text-2xl
                                       font-bold text-slate-900">

                                Active Class Session

                            </h2>

                            <p class="mt-1 text-sm text-slate-500">

                                Kelas yang sedang berlangsung
                                saat ini.

                            </p>

                        </div>

                        <div class="hidden sm:flex
                                    w-11 h-11 rounded-xl
                                    bg-blue-100
                                    items-center justify-center
                                    text-xl">

                            📅

                        </div>

                    </div>

                </div>


                {{-- SESSION LIST --}}

                <div class="p-5 sm:p-7 space-y-4">


                    @forelse($sessions as $session)

                        <div class="group
                                    border border-slate-200
                                    rounded-2xl
                                    p-5 sm:p-6
                                    hover:border-blue-300
                                    hover:shadow-md
                                    transition-all duration-200">


                            <div class="flex flex-col
                                        lg:flex-row
                                        lg:items-center
                                        lg:justify-between
                                        gap-5">


                                {{-- SESSION INFORMATION --}}

                                <div class="flex items-start gap-4">


                                    {{-- ICON --}}

                                    <div class="flex-shrink-0
                                                w-12 h-12
                                                rounded-xl
                                                bg-blue-100
                                                flex items-center
                                                justify-center
                                                text-2xl">

                                        📚

                                    </div>


                                    <div>

                                        {{-- CLASS --}}

                                        <h3 class="text-lg sm:text-xl
                                                   font-bold
                                                   text-slate-900">

                                            {{ $session->schedule->classRoom->name }}

                                        </h3>


                                        {{-- SUBJECT --}}

                                        <p class="mt-1
                                                  text-blue-600
                                                  font-medium">

                                            {{ $session->schedule->subject->name }}

                                        </p>


                                        {{-- TEACHER --}}

                                        <div class="flex flex-wrap
                                                    items-center
                                                    gap-x-4 gap-y-2
                                                    mt-3
                                                    text-sm
                                                    text-slate-500">

                                            <span class="flex items-center gap-1.5">

                                                👨‍🏫

                                                <span>
                                                    {{ $session->teacher->user->name }}
                                                </span>

                                            </span>


                                            <span class="flex items-center gap-1.5">

                                                🟢

                                                <span class="text-green-600 font-medium">
                                                    Session Active
                                                </span>

                                            </span>

                                        </div>

                                    </div>

                                </div>


                                {{-- ATTENDANCE BUTTON --}}

                                <div class="lg:flex-shrink-0">

                                    <form
                                        method="POST"
                                        action="{{ route('student.attendance.store', $session) }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="w-full lg:w-auto
                                                   inline-flex
                                                   items-center
                                                   justify-center
                                                   gap-2
                                                   px-6 py-3
                                                   bg-blue-600
                                                   hover:bg-blue-700
                                                   active:bg-blue-800
                                                   text-white
                                                   rounded-xl
                                                   font-semibold
                                                   shadow-sm
                                                   hover:shadow-md
                                                   transition-all
                                                   duration-200"
                                        >

                                            <span class="text-lg">
                                                ✓
                                            </span>

                                            Saya Hadir

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>


                    @empty

                        {{-- EMPTY STATE --}}

                        <div class="text-center
                                    py-14">

                            <div class="mx-auto
                                        w-20 h-20
                                        rounded-2xl
                                        bg-slate-100
                                        flex items-center
                                        justify-center
                                        text-4xl">

                                📅

                            </div>

                            <h3 class="mt-5
                                       text-lg
                                       font-bold
                                       text-slate-900">

                                Tidak ada kelas aktif

                            </h3>

                            <p class="mt-2
                                      text-sm
                                      text-slate-500
                                      max-w-md
                                      mx-auto">

                                Belum ada sesi kelas yang
                                sedang berlangsung.

                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- ================= FOOTER INFO ================= --}}

            <div class="mt-6 text-center">

                <p class="text-xs text-slate-400">

                    ClassSync • Student Attendance System

                </p>

            </div>

        </div>

    </div>

</x-app-layout>