@extends('layouts.admin')

@section('page-title', 'Tambah Kelas')

@section('content')

<div class="max-w-2xl">

    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900">
            Tambah Kelas
        </h2>

        <p class="text-gray-500 mt-1">
            Tambahkan kelas baru ke sistem.
        </p>

    </div>


    @if ($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200
                    text-red-700 rounded-lg p-4">

            <ul class="list-disc list-inside text-sm">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 p-6">

        <form method="POST"
              action="{{ route('admin.kelas.store') }}">

            @csrf

            <div>

                <label for="name"
                       class="block text-sm font-medium text-gray-700 mb-2">

                    Nama Kelas

                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: XI RPL A"
                    required
                    autofocus
                    class="w-full rounded-lg border-gray-300
                           focus:border-blue-500
                           focus:ring-blue-500">

            </div>


            <div class="flex justify-end gap-3 mt-6">

                <a href="{{ route('admin.kelas') }}"
                   class="px-5 py-2.5 rounded-lg
                          bg-gray-200 text-gray-700
                          hover:bg-gray-300">

                    Batal

                </a>


                <button type="submit"
                        class="px-5 py-2.5 rounded-lg
                               bg-blue-600 text-white
                               hover:bg-blue-700">

                    Simpan Kelas

                </button>

            </div>

        </form>

    </div>

</div>

@endsection