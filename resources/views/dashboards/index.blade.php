<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Dashboard</title>

  <link rel="stylesheet" href="{{ asset('/a/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/a/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('/a/css/style.css') }}">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    @include('dashboards.partials.aside')

    <div class="admin-main">
      @include('dashboards.partials.navbar')

      @yield('content')
    </div>
  </div>

  <script src="{{ asset('/a/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/a/js/main.js') }}"></script>
  @stack('scripts')
</body>
</html>
