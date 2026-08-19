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
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <div class="flex">

             <x-teacher-sidebar />


            <!-- Main Content -->
            <main class="flex-1 p-8">

                <!-- Header -->
                <div class="mb-8">

                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        Scan Class QR
                    </h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        Scan the QR code displayed in your classroom.
                    </p>

                </div>


                <!-- Scanner Card -->
                <div class="max-w-2xl mx-auto">

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-8">

                        <div class="text-center">

                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                Scan QR Code
                            </h2>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Position the classroom QR code inside the frame.
                            </p>

                        </div>


                       <!-- Scanner Area -->
<div class="mt-8 flex justify-center">

    <div class="w-full max-w-md">

        <!-- Camera Container -->
        <div
            class="relative w-full aspect-square bg-gray-950 rounded-2xl overflow-hidden shadow-lg"
        >

            <!-- QR Scanner -->
            <div
                id="qr-reader"
                class="w-full h-full"
            ></div>

            </div>

        </div>

        <!-- Scanner Instruction -->
        <div class="mt-5 text-center">

            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                Arahkan kamera ke QR Code kelas
            </p>

            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                Pastikan QR Code berada di dalam kotak
            </p>

        </div>

    </div>

</div>

<!-- Status -->
<div class="mt-6 flex justify-center">

    <div
        class="inline-flex items-center gap-2 px-4 py-2 rounded-full
               bg-green-50 dark:bg-green-900/20
               text-green-700 dark:text-green-400"
    >

        <span class="w-2 h-2 bg-green-500 rounded-full"></span>

        <span class="text-sm font-medium">
            Camera ready
        </span>

    </div>

</div>


                        <!-- Cancel -->
                        <div class="mt-6 text-center">

                            <a href="{{ route('teacher.dashboard') }}"
                               class="inline-flex items-center px-5 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                Cancel

                            </a>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>
<style>
    #qr-reader {
        border: none !important;
    }

    #qr-reader video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    #qr-reader__scan_region {
        min-height: 100% !important;
    }

    #qr-reader__dashboard {
        padding: 10px !important;
        text-align: center !important;
    }

    #qr-reader__dashboard_section {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 8px !important;
        flex-wrap: wrap !important;
    }
</style>


</x-app-layout>