@extends('layouts.admin')

@section('page-title', 'Data Siswa')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200
                    px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif


    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Data Siswa
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola data siswa ClassSync.
            </p>
        </div>


        <a
            href="{{ route('admin.siswa.create') }}"
            class="bg-blue-600 hover:bg-blue-700
                   text-white px-5 py-2.5 rounded-lg
                   transition"
        >
            + Tambah Siswa
        </a>

    </div>


    {{-- VALIDATION ERROR --}}
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


    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b bg-gray-50">

                        <th class="text-left px-6 py-4 text-sm">
                            No
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Nama
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            NIS
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Email
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Kelas
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($students as $index => $student)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>


                            <td class="px-6 py-4 font-medium">
                                {{ $student->name }}
                            </td>


                            <td class="px-6 py-4">
                                {{ $student->nis ?? '-' }}
                            </td>


                            <td class="px-6 py-4">
                                {{ $student->email }}
                            </td>


                            <td class="px-6 py-4">

                                @forelse($student->classes as $class)

                                    <span class="inline-block
                                                 px-3 py-1
                                                 rounded-full
                                                 bg-blue-50
                                                 text-blue-700
                                                 text-sm
                                                 mr-1">

                                        {{ $class->name }}

                                    </span>

                                @empty

                                    <span class="text-gray-400">
                                        Belum ada kelas
                                    </span>

                                @endforelse

                            </td>


                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <a
                                        href="{{ route('admin.siswa.edit', $student->id) }}"
                                        class="text-blue-600
                                               hover:text-blue-800
                                               font-medium"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route('admin.siswa.destroy', $student->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus siswa ini?')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="text-red-600
                                                   hover:text-red-800
                                                   font-medium"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="text-center py-12 text-gray-500"
                            >

                                Belum ada data siswa.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection