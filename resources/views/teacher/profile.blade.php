@extends('layouts.teacher')

@section('title', 'Profile | ClassSync')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-900">
            Profile
        </h1>

        <p class="text-slate-500 mt-2">
            Manage your teacher profile.
        </p>

    </div>


    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm p-8">

        <div class="flex items-center gap-5 mb-8">

            <div
                class="w-20 h-20
                       rounded-full
                       bg-blue-600
                       text-white
                       flex items-center justify-center
                       text-3xl font-bold">

                {{ strtoupper(substr(Auth::user()->name ?? 'T', 0, 1)) }}

            </div>


            <div>

                <h2 class="text-2xl font-bold">
                    {{ Auth::user()->name ?? 'Teacher' }}
                </h2>

                <p class="text-slate-500">
                    Teacher
                </p>

            </div>

        </div>


        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <label class="text-sm font-medium text-slate-500">
                    Name
                </label>

                <div
                    class="mt-2
                           bg-slate-50
                           border border-slate-200
                           rounded-lg
                           px-4 py-3">

                    {{ Auth::user()->name ?? '-' }}

                </div>

            </div>


            <div>

                <label class="text-sm font-medium text-slate-500">
                    Email
                </label>

                <div
                    class="mt-2
                           bg-slate-50
                           border border-slate-200
                           rounded-lg
                           px-4 py-3">

                    {{ Auth::user()->email ?? '-' }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection