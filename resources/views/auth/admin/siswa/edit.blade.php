@extends('layouts.admin')

@section('page-title', 'Edit Siswa')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900">
            Edit Siswa
        </h2>

        <p class="text-gray-500 mt-1">
            Perbarui data siswa.
        </p>

    </div>


    @if($errors->any())

        <div class="mb-6 rounded-lg bg-red-50 border border-red-200
                    px-5 py-4 text-red-700">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.siswa.update', $user->id) }}"
        method="POST"
        class="bg-white rounded-xl shadow-sm
               border border-gray-100 p-6"
    >

        @csrf

        @method('PUT')


        {{-- NAMA --}}
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Nama Siswa
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
            >

        </div>


        {{-- NIS --}}
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                NIS
            </label>

            <input
                type="text"
                name="nis"
                value="{{ old('nis', $user->nis) }}"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
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
                value="{{ old('email', $user->email) }}"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
            >

        </div>


        {{-- KELAS --}}
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Kelas
            </label>

            @php
                $currentClassId = $user->classes->first()?->id;
            @endphp

            <select
                name="class_id"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
            >

                <option value="">
                    -- Pilih Kelas --
                </option>

                @foreach($classes as $class)

                    <option
                        value="{{ $class->id }}"
                        {{ old('class_id', $currentClassId) == $class->id ? 'selected' : '' }}
                    >

                        {{ $class->name }}

                        @if($class->room)
                            - {{ $class->room }}
                        @endif

                    </option>

                @endforeach

            </select>

        </div>


        {{-- PASSWORD --}}
        <div class="mb-2">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Password Baru
            </label>

            <input
                type="password"
                name="password"
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
                placeholder="Kosongkan jika tidak ingin mengubah"
            >

        </div>


        <p class="text-sm text-gray-500 mb-5">
            Kosongkan password jika password lama tetap digunakan.
        </p>


        {{-- CONFIRM PASSWORD --}}
        <div class="mb-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Konfirmasi Password Baru
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
                placeholder="Ulangi password baru"
            >

        </div>


        {{-- BUTTON --}}
        <div class="flex items-center justify-end gap-3">

            <a
                href="{{ route('admin.siswa') }}"
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
                Update Siswa
            </button>

        </div>

    </form>

</div>

@endsection