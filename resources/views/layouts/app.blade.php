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

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

    <!-- FONT FIX -->
    <style>

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        h1, h2, h3, h4, h5, h6,
        .navbar-brand,
        .fw-bold {
            font-family: 'Poppins', sans-serif;
        }

        .nav-link,
        p,
        span,
        label,
        input,
        button,
        table {
            font-family: 'Roboto', sans-serif;
        }

        .dashboard-content {
            min-height: 100vh;
        }

    </style>

</head>

<body class="index-page">

    <!-- NAVIGATION -->
    @include('layouts.navigation')

    <!-- HEADER -->
    @hasSection('header')

        <section class="bg-white border-bottom shadow-sm py-3">

            <div class="container-fluid px-4">

                @yield('header')

            </div>

        </section>

    @endif

    <!-- MAIN CONTENT -->
    <main class="dashboard-content py-4">

        <div class="container-fluid px-4">

            @yield('content')

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-top py-3 mt-auto">

        <div class="container-fluid px-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div class="text-muted small">
                    © {{ date('Y') }} SIGIQ — Système Intégré de Gestion des Inspections Qualité
                </div>

                <div class="small text-muted">
                    Version 2.0 • SIGIQ
                </div>

            </div>

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#"
       id="scroll-top"
       class="scroll-top d-flex align-items-center justify-content-center">

        <i class="bi bi-arrow-up-short"></i>

    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS -->
    <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>

    <script src="{{ asset('/vendor/aos/aos.js') }}"></script>

    <script src="{{ asset('/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <script src="{{ asset('/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <script src="{{ asset('/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>

    <script src="{{ asset('/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Alpine JS -->
    <script defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js">
    </script>

    <!-- Main JS -->
    <script src="{{ asset('/js/main.js') }}"></script>

    <!-- INIT -->
    <script>

        AOS.init();

    </script>

</body>

</html>