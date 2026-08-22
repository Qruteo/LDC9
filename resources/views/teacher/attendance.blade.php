@extends('layouts.teacher')

@section('title', 'My Attendance | ClassSync')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-900">
            My Attendance
        </h1>

        <p class="text-slate-500 mt-2">
            View your attendance records.
        </p>

    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        <div class="bg-white rounded-2xl
                    border border-slate-200
                    p-6 shadow-sm">

            <p class="text-sm text-slate-500">
                Present
            </p>

            <p class="text-3xl font-bold text-green-600 mt-2">
                20
            </p>

        </div>


        <div class="bg-white rounded-2xl
                    border border-slate-200
                    p-6 shadow-sm">

            <p class="text-sm text-slate-500">
                Late
            </p>

            <p class="text-3xl font-bold text-orange-500 mt-2">
                2
            </p>

        </div>


        <div class="bg-white rounded-2xl
                    border border-slate-200
                    p-6 shadow-sm">

            <p class="text-sm text-slate-500">
                Total
            </p>

            <p class="text-3xl font-bold text-blue-600 mt-2">
                22
            </p>

        </div>

    </div>


    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        <div class="p-6 border-b">

            <h2 class="font-bold text-xl">
                Attendance Records
            </h2>

        </div>


        <div class="p-6">

            <p class="text-slate-500">
                Attendance data will be displayed here.
            </p>

        </div>

    </div>

</div>

@endsection