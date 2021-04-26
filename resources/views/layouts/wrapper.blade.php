<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Indo Kencana Sakti | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('alt/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('alt/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
  <style media="screen">
    @media(max-width:576px)
    {
      .table-responsive{overflow-x:scroll;}
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
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">IKS Tracking</span>
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
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/master">Rekap</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> alpha-1.0
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
</body>
</html>
