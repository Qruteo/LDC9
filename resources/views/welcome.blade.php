<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassSync - Classroom Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
            background: #c4dcfa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            color: #111827;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: #ffffff;
            border-radius: 24px;
            padding: 38px 38px 36px;
            box-shadow: 0 15px 35px rgba(39, 86, 150, 0.08);
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 22px;
            border-bottom: 1px solid #edf0f5;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo {
            width: 76px;
            height: 76px;
            object-fit: contain;
        }

        .brand-text {
            font-size: 10px;
            font-weight: 700;
            color: #8b95a5;
            letter-spacing: 0.5px;
        }

        .buttons {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .buttons a {
            text-decoration: none;
        }

        .btn {
            border: none;
            border-radius: 13px;
            padding: 13px 25px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-login {
            background: #f1f6fc;
            color: #374151;
        }

        .btn-register {
            background: #2f65d9;
            color: white;
            box-shadow: 0 5px 12px rgba(47, 101, 217, 0.22);
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-register:hover {
            background: #2457c2;
        }

        /* HERO */
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            align-items: center;
            padding-top: 44px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #bcd7f7;
            background: #f3f8ff;
            color: #3267c8;
            border-radius: 7px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 17px;
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background: #3267c8;
            border-radius: 50%;
        }

        h1 {
            font-size: 31px;
            line-height: 1.15;
            letter-spacing: -1px;
            margin-bottom: 18px;
            font-weight: 800;
        }

        h1 .blue {
            color: #2f65d9;
        }

        .description {
            color: #687589;
            font-size: 14px;
            line-height: 1.55;
            max-width: 410px;
            margin-bottom: 24px;
        }

        /* FEATURES */
        .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            max-width: 395px;
        }

        .feature {
            border: 1px solid #e8edf4;
            background: #fbfcfe;
            border-radius: 12px;
            padding: 14px 13px;
        }

        .feature-title {
            color: #3267cf;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .feature-text {
            color: #9aa4b3;
            font-size: 11px;
        }

        /* IMAGE */
        .visual {
            position: relative;
        }

        .image-box {
            position: relative;
            height: 256px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.14);
        }

        .classroom-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .image-overlay {
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 14px;
            height: 62px;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 14px;
            display: flex;
            align-items: center;
            padding: 10px 13px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
        }

        .qr-box {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: #f5f7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 11px;
            color: #d2d7de;
            font-size: 12px;
            font-weight: bold;
        }

        .status-content {
            flex: 1;
        }

        .status-label {
            font-size: 9px;
            font-weight: 700;
            color: #9aa4b3;
            margin-bottom: 3px;
        }

        .status-title {
            font-size: 11px;
            font-weight: 800;
            color: #273244;
        }

        .active {
            background: #d5f8e6;
            color: #198754;
            font-size: 9px;
            font-weight: 800;
            padding: 5px 10px;
            border-radius: 7px;
        }

        /* RESPONSIVE */
        @media (max-width: 760px) {
            body {
                padding: 20px 12px;
            }

            .container {
                padding: 25px 22px;
                border-radius: 20px;
            }

            .hero {
                grid-template-columns: 1fr;
                gap: 30px;
                padding-top: 30px;
            }

            h1 {
                font-size: 28px;
            }

            .visual {
                order: -1;
            }

            .image-box {
                height: 230px;
            }
        }

        @media (max-width: 480px) {
            .header {
                align-items: flex-start;
            }

            .logo {
                width: 58px;
                height: 58px;
            }

            .brand-text {
                display: none;
            }

            .buttons {
                gap: 6px;
            }

            .btn {
                padding: 10px 14px;
                font-size: 12px;
            }

            .features {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

    <main class="container">

        <!-- HEADER -->
        <header class="header">

            <div class="brand">
                <!-- Ganti dengan logo ClassSync milikmu -->
                <img
                    src="{{ asset('images/classsync-logo.png') }}"
                    alt="ClassSync"
                    class="logo"
                >

                <span class="brand-text">
                    SMART ATTENDANCE
                </span>
            </div>

                        <nav class="buttons" aria-label="Autentikasi">
                            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-register">Register</a>
                        </nav>


        </header>


        <!-- HERO -->
        <section class="hero">

            <div class="content">

                <div class="badge">
                    <span class="badge-dot"></span>
                    Sistem Absensi Digital
                </div>

                <h1>
                    Classroom Management
                    &amp;
                    <span class="blue">Learning Record</span>
                    <span class="blue">System</span>
                </h1>

                <p class="description">
                    Kelola presensi siswa, guru, dan rekap harian
                    secara cepat, akurat, dan terintegrasi.
                </p>


                <div class="features">

                    <div class="feature">
                        <div class="feature-title">
                            QR Code System
                        </div>

                        <div class="feature-text">
                            Absen cepat &amp; praktis
                        </div>
                    </div>

                    <div class="feature">
                        <div class="feature-title">
                            Real-Time Data
                        </div>

                        <div class="feature-text">
                            Rekap otomatis
                        </div>
                    </div>

                </div>

            </div>


            <!-- CLASSROOM IMAGE -->
            <div class="visual">

                <div class="image-box">

                    <img
                        src="{{ asset('images/classroom.jpg') }}"
                        alt="Suasana ruang kelas"
                        class="classroom-image"
                    >

                    <div class="image-overlay">

                        <div class="qr-box">
                            QR
                        </div>

                        <div class="status-content">

                            <div class="status-label">
                                PRESENSI DIGITAL
                            </div>

                            <div class="status-title">
                                Siswa &amp; Guru Terintegrasi
                            </div>

                        </div>

                        <span class="active">
                            Active
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>
</html>