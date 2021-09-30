<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Indo Kencana Sakti | @yield('title')</title>
  @laravelPWA
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('alt/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-select/css/select.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-rowgroup/css/rowgroup.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{asset('datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/sweetalert2/sweetalert2.css')}}">
  <link rel="stylesheet" href="{{asset('/alt/plugins/toastr/toastr.min.css')}}">
  <link rel="stylesheet" href="{{asset('/css/datepicker-custom.css')}}">
  <link rel="stylesheet" href="{{asset('/css/autocomplete.css')}}">
  <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('alt/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('alt/plugins/icheck/skins/all.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('alt/dist/css/adminlte.min.css')}}">

  <!-- Web Application Manifest -->
<link rel="manifest" href="/manifest.json">
<!-- Chrome for Android theme color -->
<meta name="theme-color" content="#000000">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="PWA">
<link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="PWA">
<link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

<link href="/images/icons/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2208.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-828x1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1536x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-2048x2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

<!-- Tile for Win8 -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">


  <style media="screen">
    @media(max-width:576px)
    {
      .table-responsive{overflow-x:scroll;}
    }
    .select2-container.select2-container--default.select2-container--open  {
      z-index: 5000;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      @include('layouts.notifications')

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">IKS Trucking</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      @include('layouts.nav')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>@yield('title')</h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                @if(str_contains(url()->current(), '/management'))
                  <a href="/management/transports">Manajemen</a>
                @else
                  @if (str_contains(url()->current(), '/tracking/delivery_orders'))
                    <a href="/tracking/delivery_orders/master">Surat Jalan</a>
                  @else
                    <a href="/tracking/deliveries/master">Rekap</a>
                  @endif
                @endif
              </li>

              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      @php
        setlocale(LC_ALL, 'id_MX', 'id', 'ID');
      @endphp

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> pre-2.0
    </div>
    <strong>Copyright &copy; @if(Carbon\Carbon::now()->format("Y") != '2021')2021 - @endif{{Carbon\Carbon::now()->format("Y")}} <a href="#">Menafarsoft</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<div class="loader-overlay show page-loader">
</div>
<div class="spanner show page-loader">
  <div class="loader"></div>
  <p>Mohon menungggu, halaman sedang dimuat.</p>
</div>

<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('alt/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('alt/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('alt/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/json2/20160511/json2.min.js"></script>
<script src="{{asset('alt/plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-rowgroup/js/dataTables.rowgroup.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('alt/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('alt/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('alt/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('alt/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('alt/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('alt/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('alt/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('alt/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/alt/plugins/sweetalert2/sweetalert2.all.js')}}" charset="utf-8"></script>
<script src="{{asset('/alt/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('/jQuery-autocomplete/scripts/jquery.mockjax.js')}}"></script>
<script src="{{asset('/jQuery-autocomplete/src/jquery.autocomplete.js')}}"></script>
<script src="{{asset('alt/plugins/icheck/icheck.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('alt/dist/js/adminlte.min.js')}}"></script>
@include('layouts.bladejs')
<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            // Registration was successful
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
</script>
</body>
</html>
