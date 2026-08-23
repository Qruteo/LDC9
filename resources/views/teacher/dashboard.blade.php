@extends('layouts.teacher')

@section('title', 'Dashboard | ClassSync')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================= HEADER ================= -->

    <div class="flex flex-col md:flex-row
                md:items-center
                md:justify-between
                gap-4 mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-900">

                Good morning,
                {{ Auth::user()->name ?? 'Teacher' }}

                👋

            </h1>

            <p class="mt-2 text-slate-500">

                Welcome back to your teaching dashboard.

            </p>

        </div>


        <!-- PROFILE -->

        <div class="flex items-center gap-3">

            <div class="text-right">

                <p class="font-semibold text-slate-800">

                    {{ Auth::user()->name ?? 'Teacher' }}

                </p>

                <p class="text-sm text-slate-500">

                    Teacher

                </p>

            </div>


            <div
                class="w-12 h-12 rounded-full
                       bg-blue-600
                       text-white
                       flex items-center justify-center
                       text-lg font-bold">

                {{ strtoupper(substr(Auth::user()->name ?? 'T', 0, 1)) }}

            </div>

        </div>

    </div>


    <!-- ================= TODAY'S SCHEDULE ================= -->

    <div class="mb-8">

        <div class="mb-4">

            <h2 class="text-xl font-bold text-slate-900">

                Today's Schedule

            </h2>

            <p class="text-sm text-slate-500">

                Your teaching schedule for today

            </p>

        </div>


        <div
            class="bg-white
                   rounded-2xl
                   border border-slate-200
                   shadow-sm
                   p-6">

            <div class="flex flex-col lg:flex-row
                        lg:items-center
                        lg:justify-between
                        gap-6">


                <!-- TIME -->

                <div class="flex items-center gap-6">

                    <div class="text-center min-w-[90px]">

                        <p class="text-3xl font-bold text-blue-600">

                            08:00

                        </p>

                        <p class="text-sm text-slate-500">

                            Start

                        </p>

                    </div>


                    <div
                        class="hidden sm:block
                               w-px h-16
                               bg-slate-200">
                    </div>


                    <!-- CLASS -->

                    <div>

                        <h3 class="text-lg font-semibold text-slate-900">

                            XI RPL A

                        </h3>

                        <p class="text-slate-500">

                            Matematika

                        </p>

                        <p class="text-sm text-slate-400 mt-1">

                            📍 Lab RPL 1

                        </p>

                        <p class="text-sm text-slate-400">

                            🕘 08:00 - 09:30

                        </p>

                    </div>

                </div>


                <!-- QR BUTTON -->

                <a
                    href="{{ route('teacher.scan') }}"
                    class="inline-flex
                           items-center
                           justify-center
                           gap-2
                           bg-blue-600
                           hover:bg-blue-700
                           text-white
                           font-semibold
                           px-6
                           py-3
                           rounded-lg
                           transition">

                    📷

                    Scan Class QR

                </a>

            </div>

        </div>

    </div>


    <!-- ================= STATISTICS ================= -->

    <div
        class="grid
               grid-cols-1
               sm:grid-cols-2
               xl:grid-cols-4
               gap-5
               mb-8">


        <!-- TOTAL SESSIONS -->

        <div
            class="bg-white
                   rounded-2xl
                   border border-slate-200
                   shadow-sm
                   p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Total Sessions

                    </p>

                    <p class="text-3xl font-bold text-slate-900 mt-2">

                        24

                    </p>

                    <p class="text-sm text-slate-400 mt-1">

                        This Month

                    </p>

                </div>


                <div
                    class="w-12 h-12
                           rounded-xl
                           bg-blue-50
                           flex items-center justify-center
                           text-2xl">

                    👥

                </div>

            </div>

        </div>


        <!-- COMPLETED -->

        <div
            class="bg-white
                   rounded-2xl
                   border border-slate-200
                   shadow-sm
                   p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Session Completed

                    </p>

                    <p class="text-3xl font-bold text-slate-900 mt-2">

                        20

                    </p>

                    <p class="text-sm text-green-600 mt-1">

                        83% Completion

                    </p>

                </div>


                <div
                    class="w-12 h-12
                           rounded-xl
                           bg-green-50
                           flex items-center justify-center
                           text-2xl">

                    ✓

                </div>

            </div>

        </div>


        <!-- STUDENTS -->

        <div
            class="bg-white
                   rounded-2xl
                   border border-slate-200
                   shadow-sm
                   p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Total Students

                    </p>

                    <p class="text-3xl font-bold text-slate-900 mt-2">

                        156

                    </p>

                    <p class="text-sm text-slate-400 mt-1">

                        Across All Classes

                    </p>

                </div>


                <div
                    class="w-12 h-12
                           rounded-xl
                           bg-orange-50
                           flex items-center justify-center
                           text-2xl">

                    👥

                </div>

            </div>

        </div>


        <!-- UPCOMING -->

        <div
            class="bg-white
                   rounded-2xl
                   border border-slate-200
                   shadow-sm
                   p-6">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">

                        Upcoming Classes

                    </p>

                    <p class="text-3xl font-bold text-slate-900 mt-2">

                        3

                    </p>

                    <p class="text-sm text-slate-400 mt-1">

                        Today

                    </p>

                </div>


                <div
                    class="w-12 h-12
                           rounded-xl
                           bg-purple-50
                           flex items-center justify-center
                           text-2xl">

                    📅

                </div>

            </div>

        </div>

    </div>


    <!-- ================= RECENT SESSIONS ================= -->

    <div
        class="bg-white
               rounded-2xl
               border border-slate-200
               shadow-sm
               overflow-hidden">


        <!-- HEADER -->

        <div
            class="p-6
                   border-b border-slate-200
                   flex items-center
                   justify-between">

            <div>

                <h2 class="text-xl font-bold text-slate-900">

                    Recent Sessions

                </h2>

                <p class="text-sm text-slate-500 mt-1">

                    Your recently completed teaching sessions

                </p>

            </div>


            <a
                href="{{ route('teacher.sessions') }}"
                class="text-blue-600
                       hover:text-blue-700
                       font-semibold
                       text-sm">

                View All

            </a>

        </div>


        <!-- SESSION 1 -->

        <div
            class="p-5
                   border-b border-slate-100
                   hover:bg-slate-50
                   transition">

            <div class="flex flex-col md:flex-row
                        md:items-center
                        md:justify-between
                        gap-4">


                <div class="flex items-center gap-4">

                    <div
                        class="w-12 h-12
                               rounded-xl
                               bg-green-50
                               flex items-center justify-center
                               text-xl">

                        📚

                    </div>


                    <div>

                        <h3 class="font-semibold text-slate-900">

                            XI RPL B

                        </h3>

                        <p class="text-sm text-slate-500">

                            Pemrograman

                        </p>

                    </div>

                </div>


                <div class="text-sm text-slate-500">

                    📅 20 Aug 2026

                    <span class="mx-2">
                        |
                    </span>

                    10:00 - 11:30

                </div>


                <span
                    class="inline-flex
                           items-center
                           justify-center
                           px-4 py-2
                           rounded-full
                           bg-green-50
                           text-green-600
                           text-sm
                           font-semibold">

                    Completed

                </span>

            </div>

        </div>


        <!-- SESSION 2 -->

        <div
            class="p-5
                   border-b border-slate-100
                   hover:bg-slate-50
                   transition">

            <div class="flex flex-col md:flex-row
                        md:items-center
                        md:justify-between
                        gap-4">


                <div class="flex items-center gap-4">

                    <div
                        class="w-12 h-12
                               rounded-xl
                               bg-blue-50
                               flex items-center justify-center
                               text-xl">

                        📚

                    </div>


                    <div>

                        <h3 class="font-semibold text-slate-900">

                            XI RPL A

                        </h3>

                        <p class="text-sm text-slate-500">

                            Matematika

                        </p>

                    </div>

                </div>


                <div class="text-sm text-slate-500">

                    📅 19 Aug 2026

                    <span class="mx-2">
                        |
                    </span>

                    08:00 - 09:30

                </div>


                <span
                    class="inline-flex
                           items-center
                           justify-center
                           px-4 py-2
                           rounded-full
                           bg-green-50
                           text-green-600
                           text-sm
                           font-semibold">

                    Completed

                </span>

            </div>

        </div>


        <!-- SESSION 3 -->

        <div
            class="p-5
                   hover:bg-slate-50
                   transition">

            <div class="flex flex-col md:flex-row
                        md:items-center
                        md:justify-between
                        gap-4">


                <div class="flex items-center gap-4">

                    <div
                        class="w-12 h-12
                               rounded-xl
                               bg-purple-50
                               flex items-center justify-center
                               text-xl">

                        📚

                    </div>


                    <div>

                        <h3 class="font-semibold text-slate-900">

                            X RPL A

                        </h3>

                        <p class="text-sm text-slate-500">

                            Basis Data

                        </p>

                    </div>

                </div>


                <div class="text-sm text-slate-500">

                    📅 18 Aug 2026

                    <span class="mx-2">
                        |
                    </span>

                    13:00 - 14:30

                </div>


                <span
                    class="inline-flex
                           items-center
                           justify-center
                           px-4 py-2
                           rounded-full
                           bg-green-50
                           text-green-600
                           text-sm
                           font-semibold">

                    Completed

                </span>

            </div>

        </div>

    </div>

</div>

@endsection