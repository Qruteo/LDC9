@extends('layouts.admin')

@section('content')

<div>

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Rekap Absensi
            </h2>

            <p class="text-gray-500 mt-1">
                Lihat dan kelola rekap kehadiran siswa.
            </p>
        </div>

        <button
            class="bg-green-600 hover:bg-green-700
                   text-white px-5 py-2.5 rounded-lg">

            📊 Export Data

        </button>

    </div>


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100">

        <div class="p-6">

            <p class="text-gray-500">
                Rekap absensi akan ditampilkan di sini.
            </p>

        </div>

    </div>

</div>

@endsection