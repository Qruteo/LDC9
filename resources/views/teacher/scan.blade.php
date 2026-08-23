@extends('layouts.teacher')

@section('title', 'Scan Class QR')

@section('page-title', 'Scan Class QR')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-slate-900">
            Scan Class QR
        </h1>

        <p class="mt-2 text-slate-500">
            Scan QR Code kelas untuk memulai atau membuka sesi mengajar.
        </p>

    </div>


    <!-- MAIN QR CARD -->

    <div class="bg-white rounded-2xl border border-slate-200
                shadow-sm overflow-hidden">

        <!-- CARD HEADER -->

        <div class="px-6 py-5 border-b border-slate-200">

            <div class="flex items-center gap-4">

                <div
                    class="w-12 h-12 rounded-xl
                           bg-blue-100
                           flex items-center justify-center">

                    <span class="text-2xl">
                        📷
                    </span>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Scan QR Code Kelas
                    </h2>

                    <p class="text-sm text-slate-500">
                        Arahkan kamera ke QR Code kelas.
                    </p>

                </div>

            </div>

        </div>


        <!-- SCANNER -->

        <div class="p-8">

            <!-- ERROR -->

            @if(session('error'))

                <div
                    class="mb-6 p-4 rounded-xl
                           bg-red-50 border border-red-200
                           text-red-700">

                    {{ session('error') }}

                </div>

            @endif


            <!-- SUCCESS -->

            @if(session('success'))

                <div
                    class="mb-6 p-4 rounded-xl
                           bg-green-50 border border-green-200
                           text-green-700">

                    {{ session('success') }}

                </div>

            @endif


            <!-- CAMERA AREA -->

            <div class="max-w-xl mx-auto">

                <div
                    id="reader"
                    class="w-full rounded-2xl
                           border-2 border-slate-200
                           overflow-hidden bg-slate-50">

                </div>


                <!-- STATUS -->

                <div
                    id="scan-status"
                    class="mt-5 text-center">

                    <div class="inline-flex items-center gap-2
                                px-4 py-2 rounded-full
                                bg-blue-50 text-blue-700
                                text-sm font-medium">

                        <span>
                            📷
                        </span>

                        <span>
                            Menunggu kamera...
                        </span>

                    </div>

                </div>


                <!-- INFORMATION -->

                <div
                    class="mt-6 p-5 rounded-xl
                           bg-slate-50 border border-slate-200">

                    <h3 class="font-semibold text-slate-800">
                        Cara menggunakan QR Scanner
                    </h3>

                    <div class="mt-4 space-y-3 text-sm text-slate-600">

                        <div class="flex gap-3">

                            <span
                                class="w-6 h-6 rounded-full
                                       bg-blue-600 text-white
                                       flex items-center justify-center
                                       text-xs font-bold flex-shrink-0">

                                1

                            </span>

                            <p>
                                Izinkan browser menggunakan kamera.
                            </p>

                        </div>


                        <div class="flex gap-3">

                            <span
                                class="w-6 h-6 rounded-full
                                       bg-blue-600 text-white
                                       flex items-center justify-center
                                       text-xs font-bold flex-shrink-0">

                                2

                            </span>

                            <p>
                                Arahkan kamera ke QR Code kelas.
                            </p>

                        </div>


                        <div class="flex gap-3">

                            <span
                                class="w-6 h-6 rounded-full
                                       bg-blue-600 text-white
                                       flex items-center justify-center
                                       text-xs font-bold flex-shrink-0">

                                3

                            </span>

                            <p>
                                Tunggu sampai QR berhasil dibaca.
                            </p>

                        </div>


                        <div class="flex gap-3">

                            <span
                                class="w-6 h-6 rounded-full
                                       bg-blue-600 text-white
                                       flex items-center justify-center
                                       text-xs font-bold flex-shrink-0">

                                4

                            </span>

                            <p>
                                Kamu akan diarahkan ke sesi kelas.
                            </p>

                        </div>

                    </div>

                </div>


                <!-- MANUAL BUTTON -->

                <div class="mt-6 text-center">

                    <a
                        href="{{ route('teacher.dashboard') }}"
                        class="inline-flex items-center gap-2
                               px-5 py-3
                               rounded-lg
                               border border-slate-300
                               text-slate-600
                               font-medium
                               hover:bg-slate-50
                               transition">

                        ← Kembali ke Dashboard

                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-- INFO CARDS -->

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">


        <!-- CARD 1 -->

        <div
            class="bg-white rounded-xl
                   border border-slate-200
                   p-5">

            <div class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-blue-100
                           flex items-center justify-center">

                    📷

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Scanner
                    </p>

                    <p class="font-semibold text-slate-800">
                        Camera QR
                    </p>

                </div>

            </div>

        </div>


        <!-- CARD 2 -->

        <div
            class="bg-white rounded-xl
                   border border-slate-200
                   p-5">

            <div class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-green-100
                           flex items-center justify-center">

                    ✓

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Session
                    </p>

                    <p class="font-semibold text-slate-800">
                        Auto Connect
                    </p>

                </div>

            </div>

        </div>


        <!-- CARD 3 -->

        <div
            class="bg-white rounded-xl
                   border border-slate-200
                   p-5">

            <div class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-purple-100
                           flex items-center justify-center">

                    📚

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        ClassSync
                    </p>

                    <p class="font-semibold text-slate-800">
                        Teaching Session
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- QR SCANNER LIBRARY -->

<script src="https://unpkg.com/html5-qrcode"></script>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const status = document.getElementById('scan-status');

        function setStatus(message, type = 'normal') {

            let classes = '';

            if (type === 'success') {

                classes =
                    'bg-green-50 text-green-700';

            } else if (type === 'error') {

                classes =
                    'bg-red-50 text-red-700';

            } else {

                classes =
                    'bg-blue-50 text-blue-700';

            }

            status.innerHTML = `
                <div
                    class="inline-flex items-center gap-2
                           px-4 py-2 rounded-full
                           text-sm font-medium
                           ${classes}">

                    <span>📷</span>

                    <span>${message}</span>

                </div>
            `;

        }


        function onScanSuccess(decodedText) {

            setStatus(
                'QR berhasil dibaca. Memproses...',
                'success'
            );


            /*
             * Hentikan scanner setelah QR berhasil dibaca.
             */

            if (window.html5QrCode) {

                window.html5QrCode.stop()
                    .catch(function () {});

            }


            /*
             * Kirim hasil QR ke Laravel.
             */

            const form = document.createElement('form');

            form.method = 'POST';

            form.action =
                "{{ route('teacher.scan.validate') }}";


            const csrf = document.createElement('input');

            csrf.type = 'hidden';

            csrf.name = '_token';

            csrf.value =
                "{{ csrf_token() }}";


            const qrData = document.createElement('input');

            qrData.type = 'hidden';

           qrData.name = 'qr_token';

            qrData.value = decodedText;


            form.appendChild(csrf);

            form.appendChild(qrData);

            document.body.appendChild(form);

            form.submit();

        }


        function onScanFailure(error) {

            /*
             * Jangan tampilkan error setiap frame.
             * html5-qrcode memang akan memanggil fungsi
             * ini ketika QR belum terbaca.
             */

        }


        window.html5QrCode =
            new Html5Qrcode("reader");


        const config = {

            fps: 10,

            qrbox: {
                width: 250,
                height: 250
            }

        };


        Html5Qrcode.getCameras()
            .then(function (devices) {

                if (!devices || devices.length === 0) {

                    setStatus(
                        'Kamera tidak ditemukan.',
                        'error'
                    );

                    return;

                }


                setStatus(
                    'Arahkan kamera ke QR Code kelas.'
                );


                window.html5QrCode.start(

                    {
                        facingMode: "environment"
                    },

                    config,

                    onScanSuccess,

                    onScanFailure

                ).catch(function (error) {

                    console.error(error);

                    setStatus(
                        'Kamera tidak dapat digunakan. Pastikan izin kamera diberikan.',
                        'error'
                    );

                });

            })

            .catch(function (error) {

                console.error(error);

                setStatus(
                    'Tidak dapat mengakses kamera.',
                    'error'
                );

            });

    });

</script>

@endsection