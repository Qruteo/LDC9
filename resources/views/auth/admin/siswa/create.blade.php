@extends('layouts.admin')

@section('page-title', 'Tambah Siswa')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900">
            Tambah Siswa
        </h2>

        <p class="text-gray-500 mt-1">
            Tambahkan akun siswa baru ke ClassSync.
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
        action="{{ route('admin.siswa.store') }}"
        method="POST"
        class="bg-white rounded-xl shadow-sm
               border border-gray-100 p-6"
    >

        @csrf


        {{-- NAMA --}}
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Nama Siswa
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
                placeholder="Nama lengkap siswa"
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
                value="{{ old('nis') }}"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
                placeholder="Nomor Induk Siswa"
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
                value="{{ old('email') }}"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
                placeholder="siswa@example.com"
            >

        </div>


        {{-- KELAS --}}
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Kelas
            </label>

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
                        {{ old('class_id') == $class->id ? 'selected' : '' }}
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
        <div class="mb-5">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
                placeholder="Minimal 8 karakter"
            >

        </div>


        {{-- CONFIRM PASSWORD --}}
        <div class="mb-6">

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full rounded-lg border-gray-300
                       focus:border-blue-500 focus:ring-blue-500"
                placeholder="Ulangi password"
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
                Simpan Siswa
            </button>

        </div>

    </form>

</div>

@endsection