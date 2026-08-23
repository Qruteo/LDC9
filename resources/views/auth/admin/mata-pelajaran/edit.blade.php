@extends('layouts.admin')

@section('page-title', 'Edit Mata Pelajaran')

@section('content')

<div>

    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900">
            Edit Mata Pelajaran
        </h2>

        <p class="text-gray-500 mt-1">
            Perbarui data mata pelajaran.
        </p>

    </div>


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 p-6">

        <form method="POST"
              action="{{ route('admin.mata-pelajaran.update', $subject) }}">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label for="name"
                       class="block text-sm font-medium text-gray-700 mb-2">

                    Nama Mata Pelajaran

                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $subject->name) }}"
                    required
                    maxlength="255"
                    class="w-full border border-gray-300 rounded-lg
                           px-4 py-2.5 focus:ring-2
                           focus:ring-blue-500 focus:border-blue-500">

                @error('name')

                    <p class="text-red-600 text-sm mt-2">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            <div class="flex items-center gap-3">

                <a href="{{ route('admin.mata-pelajaran') }}"
                   class="px-5 py-2.5 rounded-lg
                          border border-gray-300
                          text-gray-700 hover:bg-gray-50">

                    Batal

                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700
                               text-white px-5 py-2.5 rounded-lg">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection