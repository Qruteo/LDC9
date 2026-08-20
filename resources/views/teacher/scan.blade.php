<x-app-layout>
@vite(['resources/css/app.css', 'resources/js/app.js'])

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const qrReader = document.getElementById('qr-reader');

    if (!qrReader) {
        console.error('QR reader tidak ditemukan.');
        return;
    }

    const qrScanner = new Html5Qrcode('qr-reader');

    const config = {
        fps: 10,
        qrbox: {
            width: 220,
            height: 220
        }
    };

    // Pengaman agar QR hanya diproses satu kali
    let isProcessing = false;

    qrScanner.start(
        { facingMode: 'environment' },
        config,

        function (decodedText) {

            // Kalau sedang memproses QR, abaikan deteksi berikutnya
            if (isProcessing) {
                return;
            }

            isProcessing = true;

            console.log("QR Code:", decodedText);

            qrScanner.stop()
                .then(() => {

                    return fetch("{{ route('teacher.scan.validate') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            qr_token: decodedText
                        })
                    });

                })
                .then(response => response.json())
                .then(data => {

                    if (data.success) {

                        alert(
                            "✅ QR BERHASIL DIVALIDASI!\n\n" +
                            "Guru: " + data.teacher + "\n" +
                            "Kelas: " + data.class + "\n" +
                            "Ruangan: " + data.room + "\n" +
                            "Mapel: " + data.subject
                        );

                        window.location.href =
                            "{{ route('teacher.session') }}?session=" +
                            data.session_id;

                    } else {

                        alert("❌ " + data.message);

                        window.location.reload();

                    }

                })
                .catch(error => {

                    console.error(error);

                    alert("Terjadi kesalahan saat memvalidasi QR.");

                    window.location.reload();

                });

        },

        function () {
            // Scanner sedang mencari QR.
        }

    ).catch(function (error) {

        console.error("Tidak dapat mengakses kamera:", error);

    });

});
</script>


    <div class="min-h-screen bg-slate-50 dark:bg-gray-950">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="hidden lg:flex w-64 flex-col bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800">

            <!-- Logo -->
            <div class="h-20 px-6 flex items-center border-b border-gray-100 dark:border-gray-800">

                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow-sm">
                    <span class="text-white text-xl font-bold">
                        ✓
                    </span>
                </div>

                <span class="ml-3 text-xl font-bold text-blue-600">
                    Attendfy
                </span>

            </div>


            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('teacher.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-gray-600 dark:text-gray-300
                          hover:bg-blue-50 dark:hover:bg-gray-800
                          hover:text-blue-600 transition">

                    <span class="text-lg">🏠</span>

                    <span class="font-medium">
                        Dashboard
                    </span>

                </a>


                <!-- Active -->
                <a href="{{ route('teacher.scan') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          bg-blue-600 text-white shadow-sm">

                    <span class="text-lg">📷</span>

                    <span class="font-semibold">
                        Scan Class QR
                    </span>

                </a>


                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-gray-600 dark:text-gray-300
                          hover:bg-blue-50 dark:hover:bg-gray-800
                          hover:text-blue-600 transition">

                    <span class="text-lg">📚</span>

                    <span class="font-medium">
                        My Sessions
                    </span>

                </a>


                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-gray-600 dark:text-gray-300
                          hover:bg-blue-50 dark:hover:bg-gray-800
                          hover:text-blue-600 transition">

                    <span class="text-lg">🕐</span>

                    <span class="font-medium">
                        My Attendance
                    </span>

                </a>


                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-gray-600 dark:text-gray-300
                          hover:bg-blue-50 dark:hover:bg-gray-800
                          hover:text-blue-600 transition">

                    <span class="text-lg">📅</span>

                    <span class="font-medium">
                        Schedule
                    </span>

                </a>


                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-gray-600 dark:text-gray-300
                          hover:bg-blue-50 dark:hover:bg-gray-800
                          hover:text-blue-600 transition">

                    <span class="text-lg">📜</span>

                    <span class="font-medium">
                        Session History
                    </span>

                </a>


                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-gray-600 dark:text-gray-300
                          hover:bg-blue-50 dark:hover:bg-gray-800
                          hover:text-blue-600 transition">

                    <span class="text-lg">👤</span>

                    <span class="font-medium">
                        Profile
                    </span>

                </a>

            </nav>

        </aside>


        <!-- MAIN -->
        <main class="flex-1">

            <!-- TOP BAR -->
            <header class="h-20 bg-white dark:bg-gray-900
                           border-b border-gray-200 dark:border-gray-800
                           flex items-center justify-between px-6 lg:px-10">

                <div class="flex items-center gap-3">

                    <a href="{{ route('teacher.dashboard') }}"
                       class="text-gray-500 hover:text-blue-600 transition">

                        ←

                    </a>

                    <span class="text-sm text-gray-400">
                        Dashboard
                    </span>

                    <span class="text-gray-300">
                        /
                    </span>

                    <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                        Scan QR
                    </span>

                </div>


                <!-- User -->
                <div class="flex items-center gap-3">

                    <div class="hidden sm:block text-right">

                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            Pak Budi
                        </p>

                        <p class="text-xs text-gray-500">
                            Teacher
                        </p>

                    </div>

                    <div class="w-10 h-10 rounded-full bg-blue-600
                                flex items-center justify-center">

                        <span class="text-white font-bold">
                            B
                        </span>

                    </div>

                </div>

            </header>


            <!-- CONTENT -->
            <div class="p-6 lg:p-10">

                <div class="max-w-4xl mx-auto">


                    <!-- PAGE HEADER -->
                    <div class="mb-8">

                        <div class="flex items-center gap-3 mb-3">

                            <div class="w-11 h-11 rounded-xl bg-blue-100
                                        flex items-center justify-center">

                                <span class="text-2xl">
                                    📷
                                </span>

                            </div>

                            <div>

                                <h1 class="text-2xl lg:text-3xl font-bold
                                           text-gray-900 dark:text-white">

                                    Scan Class QR

                                </h1>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">

                                    Scan the QR code displayed in your classroom.

                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- SCANNER CARD -->
                    <div class="bg-white dark:bg-gray-900
                                rounded-2xl
                                border border-gray-200 dark:border-gray-800
                                shadow-sm overflow-hidden">


                        <!-- CARD HEADER -->
                        <div class="px-6 lg:px-8 py-5
                                    border-b border-gray-100 dark:border-gray-800">

                            <div class="flex items-center justify-between">

                                <div>

                                    <h2 class="font-semibold text-gray-900 dark:text-white">

                                        Classroom Scanner

                                    </h2>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Position the classroom QR code inside the frame.

                                    </p>

                                </div>


                                <!-- Status -->
                                <div class="hidden sm:flex items-center gap-2
                                            px-3 py-1.5 rounded-full
                                            bg-green-50 dark:bg-green-900/20">

                                    <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                    <span class="text-xs font-medium text-green-700 dark:text-green-400">

                                        Camera Ready

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- SCANNER -->
                        <div class="p-6 lg:p-10">

                            <div class="max-w-lg mx-auto">


                                <!-- CAMERA FRAME -->
                                <div class="qr-camera-wrapper">

                                    <div id="qr-reader"></div>

                                    <!-- Scan corners -->
                                    <div class="scan-corner top-left"></div>
                                    <div class="scan-corner top-right"></div>
                                    <div class="scan-corner bottom-left"></div>
                                    <div class="scan-corner bottom-right"></div>

                                    <!-- Scan line -->
                                    <div class="scan-line"></div>

                                </div>


                                <!-- Status Mobile -->
                                <div class="flex sm:hidden justify-center mt-5">

                                    <div class="inline-flex items-center gap-2
                                                px-3 py-1.5 rounded-full
                                                bg-green-50">

                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                        <span class="text-xs font-medium text-green-700">

                                            Camera Ready

                                        </span>

                                    </div>

                                </div>


                                <!-- Instructions -->
                                <div class="text-center mt-7">

                                    <h3 class="font-semibold text-gray-900 dark:text-white">

                                        Arahkan kamera ke QR Code kelas

                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">

                                        Pastikan QR Code berada di dalam kotak
                                        dan terlihat jelas.

                                    </p>

                                </div>


                                <!-- Tips -->
                                <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3">

                                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800 text-center">

                                        <div class="text-xl mb-2">
                                            💡
                                        </div>

                                        <p class="text-xs text-gray-600 dark:text-gray-300">
                                            Gunakan pencahayaan yang cukup
                                        </p>

                                    </div>


                                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800 text-center">

                                        <div class="text-xl mb-2">
                                            📱
                                        </div>

                                        <p class="text-xs text-gray-600 dark:text-gray-300">
                                            Posisikan QR di tengah frame
                                        </p>

                                    </div>


                                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-800 text-center">

                                        <div class="text-xl mb-2">
                                            🔒
                                        </div>

                                        <p class="text-xs text-gray-600 dark:text-gray-300">
                                            QR digunakan untuk validasi kelas
                                        </p>

                                    </div>

                                </div>


                                <!-- BACK BUTTON -->
                                <div class="mt-8 flex justify-center">

                                    <a href="{{ route('teacher.dashboard') }}"
                                       class="inline-flex items-center gap-2
                                              px-5 py-2.5
                                              rounded-xl
                                              border border-gray-300 dark:border-gray-700
                                              text-sm font-semibold
                                              text-gray-700 dark:text-gray-300
                                              hover:bg-gray-50 dark:hover:bg-gray-800
                                              transition">

                                        ← Back to Dashboard

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- INFO -->
                    <div class="mt-5 flex items-start gap-3
                                p-4 rounded-xl
                                bg-blue-50 dark:bg-blue-900/20
                                border border-blue-100 dark:border-blue-900/30">

                        <span class="text-lg">
                            ℹ️
                        </span>

                        <div>

                            <p class="text-sm font-medium text-blue-800 dark:text-blue-300">
                                Cara kerja
                            </p>

                            <p class="text-xs text-blue-700 dark:text-blue-400 mt-1">
                                Setelah QR berhasil dipindai, sistem akan memvalidasi
                                kelas dan guru sebelum membuka sesi pembelajaran.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</div>
<style>

    /* =========================
       QR CAMERA
    ========================= */

    .qr-camera-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        background: #020617;
        border-radius: 20px;
        overflow: hidden;
        box-shadow:
            0 15px 35px rgba(15, 23, 42, 0.15);
    }


    #qr-reader {
        width: 100% !important;
        height: 100% !important;
        border: none !important;
    }


    #qr-reader video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }


    #qr-reader__scan_region {
        min-height: 100% !important;
        border: none !important;
    }


    /* Hilangkan tampilan bawaan yang tidak diperlukan */

    #qr-reader__dashboard {
        position: absolute !important;
        bottom: 10px;
        left: 0;
        right: 0;

        padding: 8px !important;

        z-index: 20;
    }


    #qr-reader__dashboard_section {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 8px !important;
        flex-wrap: wrap !important;
    }


    /* =========================
       SCAN CORNERS
    ========================= */

    .scan-corner {
        position: absolute;
        width: 45px;
        height: 45px;

        border-color: #3b82f6;
        border-style: solid;

        z-index: 10;
        pointer-events: none;
    }


    .top-left {
        top: 30px;
        left: 30px;

        border-width: 4px 0 0 4px;

        border-top-left-radius: 12px;
    }


    .top-right {
        top: 30px;
        right: 30px;

        border-width: 4px 4px 0 0;

        border-top-right-radius: 12px;
    }


    .bottom-left {
        bottom: 30px;
        left: 30px;

        border-width: 0 0 4px 4px;

        border-bottom-left-radius: 12px;
    }


    .bottom-right {
        bottom: 30px;
        right: 30px;

        border-width: 0 4px 4px 0;

        border-bottom-right-radius: 12px;
    }


    /* =========================
       SCAN LINE
    ========================= */

    .scan-line {
        position: absolute;

        left: 35px;
        right: 35px;

        top: 30%;

        height: 2px;

        background: #3b82f6;

        box-shadow:
            0 0 10px rgba(59, 130, 246, 0.8);

        animation: scanAnimation 2.2s ease-in-out infinite;

        z-index: 9;

        pointer-events: none;
    }


    @keyframes scanAnimation {

        0% {
            top: 30%;
            opacity: 0.4;
        }

        50% {
            top: 70%;
            opacity: 1;
        }

        100% {
            top: 30%;
            opacity: 0.4;
        }

    }


    /* =========================
       MOBILE
    ========================= */

    @media (max-width: 640px) {

        .qr-camera-wrapper {
            border-radius: 16px;
        }

        .scan-corner {
            width: 35px;
            height: 35px;
        }

        .top-left {
            top: 20px;
            left: 20px;
        }

        .top-right {
            top: 20px;
            right: 20px;
        }

        .bottom-left {
            bottom: 20px;
            left: 20px;
        }

        .bottom-right {
            bottom: 20px;
            right: 20px;
        }

    }
</style>


</x-app-layout>