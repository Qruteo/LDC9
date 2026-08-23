@extends('layouts.admin')

@section('page-title', 'Edit Jadwal')

@section('content')

<div class="max-w-3xl">

    <div class="mb-6">

        <h2 class="text-2xl font-bold text-gray-900">
            Edit Jadwal
        </h2>

        <p class="text-gray-500 mt-1">
            Perbarui data jadwal pelajaran.
        </p>

    </div>


    @if($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">

            <ul class="list-disc list-inside">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 p-6">

        <form method="POST"
              action="{{ route('admin.jadwal.update', $schedule) }}">

            @csrf

            @method('PUT')


            <div class="space-y-5">


                <div>

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Guru

                    </label>

                    <select name="teacher_id"
                            required
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-2.5">

                        @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_id', $schedule->teacher_id) == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->user->name ?? 'Guru #' . $teacher->id }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Kelas

                    </label>

                    <select name="class_id"
                            required
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-2.5">

                        @foreach($classes as $class)

                            <option value="{{ $class->id }}"
                                {{ old('class_id', $schedule->class_id) == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Mata Pelajaran

                    </label>

                    <select name="subject_id"
                            required
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-2.5">

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}"
                                {{ old('subject_id', $schedule->subject_id) == $subject->id ? 'selected' : '' }}>

                                {{ $subject->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label class="block text-sm font-medium
                                  text-gray-700 mb-2">

                        Hari

                    </label>

                    <select name="day"
                            required
                            class="w-full border border-gray-300
                                   rounded-lg px-4 py-2.5">

                        @foreach($days as $day)

                            <option value="{{ $day }}"
                                {{ old('day', $schedule->day) == $day ? 'selected' : '' }}>

                                {{ $day }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <label class="block text-sm font-medium
                                      text-gray-700 mb-2">

                            Jam Mulai

                        </label>

                        <input type="time"
                               name="start_time"
                               value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                               required
                               class="w-full border border-gray-300
                                      rounded-lg px-4 py-2.5">

                    </div>


                    <div>

                        <label class="block text-sm font-medium
                                      text-gray-700 mb-2">

                            Jam Selesai

                        </label>

                        <input type="time"
                               name="end_time"
                               value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                               required
                               class="w-full border border-gray-300
                                      rounded-lg px-4 py-2.5">

                    </div>

                </div>


                <div class="flex items-center gap-3 pt-4">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700
                                   text-white px-5 py-2.5 rounded-lg">

                        Simpan Perubahan

                    </button>


                    <a href="{{ route('admin.jadwal') }}"
                       class="bg-gray-100 hover:bg-gray-200
                              text-gray-700 px-5 py-2.5 rounded-lg">

                        Batal

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection