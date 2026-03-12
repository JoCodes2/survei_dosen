<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | SIASCEND</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/assets/stmik.png') }}" />
    <script>
        let appUrl = '{{ env('APP_URL') }}';
    </script>

    @include('Layouts.Styles')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

        :root {
            --primary: #696cff;
            --primary-dark: #5f61e6;
            --glass: rgba(255, 255, 255, 0.8);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Animated Mesh Background */
        .mesh-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-color: #0f172a;
            background-image:
                radial-gradient(at 0% 0%, rgba(105, 108, 255, 0.3) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 210, 255, 0.2) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(105, 108, 255, 0.2) 0px, transparent 50%);
            animation: mesh-anim 15s ease infinite alternate;
        }

        @keyframes mesh-anim {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .login-container {
            display: flex;
            width: 1000px;
            max-width: 95%;
            height: 600px;
            background: var(--glass);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeIn 0.8s ease-out;
        }

        /* Sisi Visual (Kiri) */
        .brand-section {
            flex: 1;
            background: linear-gradient(135deg, rgba(105, 108, 255, 0.9), rgba(80, 82, 230, 0.9));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }

        .brand-section::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.1;
        }

        /* Sisi Form (Kanan) */
        .form-section {
            flex: 1.2;
            padding: 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .welcome-text h2 {
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .input-box {
            position: relative;
            margin-bottom: 25px;
        }

        .input-box label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            background: #f8fafc;
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
        }

        .input-field:focus {
            border-color: var(--primary);
            background: white;
            outline: none;
            box-shadow: 0 0 0 4px rgba(105, 108, 255, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(105, 108, 255, 0.3);
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(105, 108, 255, 0.4);
        }

        .partners {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }

        .partners img {
            height: 35px;
            filter: grayscale(1);
            opacity: 0.5;
            transition: 0.3s;
        }

        .partners img:hover {
            filter: grayscale(0);
            opacity: 1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .brand-section {
                display: none;
            }

            .login-container {
                width: 400px;
                height: auto;
            }

            .form-section {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="mesh-bg"></div>

    <div class="login-container">
        <div class="brand-section">
            <img src="{{ asset('assets/img/adiguna.png') }}" width="120"
                style="filter: brightness(0) invert(1); margin-bottom: 20px;">
            <h1 style="font-weight: 800; font-size: 2.5rem; margin-bottom: 10px;">SIASCEND</h1>
            <p style="font-size: 1.1rem; opacity: 0.9;">Sistem Penilaian Dosen STMIK Adhi Guna</p>
            <div
                style="margin-top: 30px; font-size: 0.9rem; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px;">
                "Menilai untuk miningkatkan kualitas pendidikan"
            </div>
        </div>

        <div class="form-section">
            <div class="welcome-text">
                <h2>Selamat Datang!</h2>
                <p class="text-muted mb-4">Silahkan masuk ke panel akses Anda</p>
            </div>

            <form id="loginForm" method="POST">
                @csrf
                <div class="input-box">
                    <label>Email</label>
                    <input type="email" name="email" class="input-field" placeholder="exx@gmail.com" required>
                </div>

                <div class="input-box">
                    <label>Password</label>
                    <input type="password" name="password" class="input-field" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-login" id="btnLogin">
                    MASUK SEKARANG <i class="bx bx-right-arrow-alt"></i>
                </button>
            </form>

            <div class="partners">
                <img src="{{ asset('assets/img/20241107_171817.jpg') }}" alt="Logo 1">
            </div>
        </div>
    </div>

    @include('Layouts.Scripts')
    {{-- <script>
        window.location.href = `/`;
    </script> --}}

    <script type="module" src="{{ asset('controllers/login.controller.js') }}"></script>

</body>

</html>
