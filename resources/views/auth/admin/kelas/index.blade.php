@extends('layouts.admin')

@section('page-title', 'Data Kelas')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-900">
                Data Kelas
            </h2>

            <p class="text-gray-500 mt-1">
                Kelola kelas, siswa, dan QR Code kelas.
            </p>
        </div>

        <a
            href="{{ route('admin.kelas.create') }}"
            class="bg-blue-600 hover:bg-blue-700
                   text-white px-5 py-2.5 rounded-lg
                   transition"
        >
            + Tambah Kelas
        </a>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="mb-6 bg-green-50 border border-green-200
                    text-green-700 px-4 py-3 rounded-lg">

            {{ session('success') }}

        </div>

    @endif


    {{-- ERROR --}}
    @if(session('error'))

        <div class="mb-6 bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">

            {{ session('error') }}

        </div>

    @endif


    {{-- VALIDATION ERROR --}}
    @if($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">

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

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm">
                            No
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Kelas
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Ruangan
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Jumlah Siswa
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            QR Token
                        </th>

                        <th class="text-left px-6 py-4 text-sm">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @forelse($classes as $index => $class)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $index + 1 }}
                            </td>


                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-900">
                                    {{ $class->name }}
                                </div>

                            </td>


                            <td class="px-6 py-4 text-gray-600">

                                {{ $class->room ?? '-' }}

                            </td>


                            <td class="px-6 py-4">

                                <span
                                    class="px-3 py-1 rounded-full
                                           bg-blue-50 text-blue-700
                                           text-sm font-semibold"
                                >

                                    {{ $class->students_count }} siswa

                                </span>

                            </td>


                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <code class="text-xs bg-gray-100 px-2 py-1 rounded font-mono font-bold text-gray-800">
                                        {{ $class->qr_token }}
                                    </code>
                                    <a
                                        href="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data={{ urlencode($class->qr_token) }}"
                                        target="_blank"
                                        title="Buka QR Code Image"
                                        class="px-2 py-1 text-xs bg-emerald-100 text-emerald-700 font-semibold rounded hover:bg-emerald-200 transition"
                                    >
                                        📷 QR Code
                                    </a>
                                </div>
                            </td>


                            <td class="px-6 py-4">

                                <div class="flex items-center gap-2">

                                    <a
                                        href="{{ route(
                                            'admin.kelas.students',
                                            $class
                                        ) }}"
                                        class="px-3 py-2
                                               bg-purple-600
                                               text-white
                                               rounded-lg
                                               text-sm
                                               hover:bg-purple-700"
                                    >
                                        Siswa
                                    </a>


                                    <a
                                        href="{{ route(
                                            'admin.kelas.edit',
                                            $class
                                        ) }}"
                                        class="px-3 py-2
                                               bg-blue-600
                                               text-white
                                               rounded-lg
                                               text-sm
                                               hover:bg-blue-700"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'admin.kelas.destroy',
                                            $class
                                        ) }}"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus kelas ini?'
                                        )"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-2
                                                   bg-red-600
                                                   text-white
                                                   rounded-lg
                                                   text-sm
                                                   hover:bg-red-700"
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
                                class="text-center
                                       py-12
                                       text-gray-500"
                            >

                                Belum ada data kelas.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection