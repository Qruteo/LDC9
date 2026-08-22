@extends('layouts.teacher')

@section('title', 'Schedule | ClassSync')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-900">
            Schedule
        </h1>

        <p class="text-slate-500 mt-2">
            Your teaching schedule.
        </p>

    </div>


    <div class="grid gap-4">

        @foreach([
            ['08:00', '09:30', 'XI RPL A', 'Matematika', 'Lab RPL 1'],
            ['10:00', '11:30', 'XI RPL B', 'Pemrograman', 'Lab RPL 2'],
            ['13:00', '14:30', 'X RPL A', 'Basis Data', 'Lab RPL 1']
        ] as $schedule)

        <div
            class="bg-white
                   rounded-2xl
                   border border-slate-200
                   shadow-sm
                   p-6">

            <div class="flex flex-col md:flex-row
                        md:items-center
                        gap-6">

                <div class="text-center min-w-[110px]">

                    <p class="text-2xl font-bold text-blue-600">
                        {{ $schedule[0] }}
                    </p>

                    <p class="text-sm text-slate-400">
                        {{ $schedule[1] }}
                    </p>

                </div>


                <div class="hidden md:block
                            w-px h-14
                            bg-slate-200">
                </div>


                <div>

                    <h3 class="font-bold text-lg">
                        {{ $schedule[2] }}
                    </h3>

                    <p class="text-slate-500">
                        {{ $schedule[3] }}
                    </p>

                    <p class="text-sm text-slate-400 mt-1">
                        📍 {{ $schedule[4] }}
                    </p>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection