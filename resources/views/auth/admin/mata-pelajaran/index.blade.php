@extends('layouts.admin')

@section('content')

<div>

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Mata Pelajaran
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola mata pelajaran ClassSync.
            </p>
        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700
                   text-white px-5 py-2.5 rounded-lg">

            + Tambah Mata Pelajaran

        </button>

    </div>


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100">

        <div class="p-6">

            <p class="text-gray-500">
                Data mata pelajaran akan ditampilkan di sini.
            </p>

        </div>

    </div>

</div>

@endsection