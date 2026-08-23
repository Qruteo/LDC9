@extends('layouts.admin')

@section('page-title', 'Edit Guru')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900">
            Edit Guru
        </h2>

        <p class="text-gray-500 mt-1">
            Perbarui informasi guru.
        </p>

    </div>


    @if($errors->any())

        <div class="mb-6 px-4 py-3 rounded-lg
                    bg-red-50 border border-red-200
                    text-red-700">

            <ul class="list-disc list-inside text-sm">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 p-6">

        <form
            method="POST"
            action="{{ route('admin.guru.update', $teacher) }}"
        >

            @csrf
            @method('PUT')


            {{-- NAMA --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Guru
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $teacher->user->name) }}"
                    required
                    class="w-full rounded-lg border-gray-300
                           focus:border-blue-500
                           focus:ring-blue-500"
                >

            </div>


            {{-- TEACHER CODE --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Teacher Code
                </label>

                <input
                    type="text"
                    name="teacher_code"
                    value="{{ old('teacher_code', $teacher->teacher_code) }}"
                    required
                    class="w-full rounded-lg border-gray-300
                           focus:border-blue-500
                           focus:ring-blue-500"
                >

            </div>


            {{-- EMAIL --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $teacher->user->email) }}"
                    required
                    class="w-full rounded-lg border-gray-300
                           focus:border-blue-500
                           focus:ring-blue-500"
                >

            </div>


            {{-- PASSWORD --}}
            <div class="mb-5">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full rounded-lg border-gray-300
                           focus:border-blue-500
                           focus:ring-blue-500"
                    placeholder="Kosongkan jika tidak ingin mengganti"
                >

                <p class="text-xs text-gray-500 mt-1">
                    Kosongkan jika password lama tetap digunakan.
                </p>

            </div>


            {{-- CONFIRM PASSWORD --}}
            <div class="mb-6">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full rounded-lg border-gray-300
                           focus:border-blue-500
                           focus:ring-blue-500"
                    placeholder="Ulangi password baru"
                >

            </div>


            {{-- BUTTON --}}
            <div class="flex items-center justify-end gap-3">

                <a
                    href="{{ route('admin.guru') }}"
                    class="px-5 py-2.5 rounded-lg
                           bg-gray-100 text-gray-700
                           hover:bg-gray-200"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg
                           bg-blue-600 text-white
                           hover:bg-blue-700"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection