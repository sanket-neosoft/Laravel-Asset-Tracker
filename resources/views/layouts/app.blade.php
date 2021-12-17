<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  @yield('link')
</head>

<body class="hold-transition @guest layout-top-nav @else sidebar-mini layout-fixed @endguest">
  <div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      @guest
      <div class="container">
        <a href="#" class="navbar-brand">
          <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle border" style="opacity: .8">
          <span class="brand-text">{{ config('app.name') }}</span>
        </a>
      </div>
      @else
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          @if (Route::currentRouteName() === "asset-type")
          <li class="nav-item">
            <a href="{{ url('/asset-type/add') }}" class="btn btn-outline-primary">
              <i class="fas fa-plus-circle mr-1"></i>
              Add Asset Type
            </a>
          </li>
          @endif
          @if(Route::currentRouteName() === "asset")
          <li class="nav-item">
            <a href="{{ url('/asset/add') }}" class="btn btn-outline-primary">
              <i class="fas fa-plus-circle mr-1"></i>
              Add Asset
            </a>
          </li>
          @endif
          @if(Route::currentRouteName() === "image")
          <li class="nav-item">
            <a href="{{ url('/asset/edit/' . $asset_id) }}" class="btn btn-outline-primary">
              <i class="fas fa-plus-circle mr-1"></i>
              Add Image
            </a>
          </li>
          @endif
        </ul>
      </div>
      @endguest
    </nav>
    <!-- /.navbar -->
    @yield('content')
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      @php
      use Carbon\Carbon;
      $year = Carbon::now()->format('Y');
      @endphp
      <strong>Copyright &copy; 2014-{{ $year }} <a href="https://adminlte.io">AssetTracker.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  <!-- Custom JS -->
  @yield('script')
</body>

</html>