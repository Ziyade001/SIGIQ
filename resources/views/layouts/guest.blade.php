<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIGIQ') }}</title>

    <!-- Favicons -->
    <link href="{{ asset('/img/favicon1.png') }}" rel="icon">
    <link href="{{ asset('/img/favicon1.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- AOS -->
    <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

    <!-- Custom Style -->
    <style>

        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f7f9;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6,
        .fw-bold,
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
        }

        .auth-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
            padding: 35px;
            border: none;
        }

        .auth-logo {
            height: 70px;
            object-fit: contain;
        }

    </style>

</head>

<body>

    <!-- AUTH SECTION -->
    <section class="auth-section">

        <div class="container">


                        <!-- AUTH CONTENT -->
                        @yield('content')


        </div>

    </section>

    <!-- Bootstrap JS -->
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AOS -->
    <script src="{{ asset('/vendor/aos/aos.js') }}"></script>

    <!-- INIT -->
    <script>

        AOS.init();

    </script>

</body>

</html>

