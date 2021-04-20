<!-- Sidebar user (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
    {{-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
  </div>
  <div class="info">
    <a href="#" class="d-block">{{Auth::user()->name}}</a>
  </div>
</div>

<!-- SidebarSearch Form -->
<div class="form-inline">
  <div class="input-group" data-widget="sidebar-search">
    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
    <div class="input-group-append">
      <button class="btn btn-sidebar">
        <i class="fas fa-search fa-fw"></i>
      </button>
    </div>
  </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-header">SURAT AJUAN</li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-envelope"></i>
        <p>
          Pengajuan Surat
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/master" class="nav-link">
            <i class="fa fa-archive nav-icon"></i>
            <p>Data Master</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../index.html" class="nav-link text-secondary">
            <i class="fa fa-shipping-fast nav-icon"></i>
            <p>Sedang Berlangsung</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../index2.html" class="nav-link text-secondary">
            <i class="fa fa-history nav-icon"></i>
            <p>Riwayat</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="{{route('new_delivery')}}" class="nav-link">
        <i class="fa fa-plus-square nav-icon"></i>
        <p>Tambah Ajuan Baru</p>
      </a>
    </li>
    <li class="nav-header">SURAT JALAN</li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-mail-bulk"></i>
        <p>
          Data Surat jalan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/master" class="nav-link">
            <i class="fa fa-archive nav-icon"></i>
            <p>Data Master</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../index.html" class="nav-link text-secondary">
            <i class="fa fa-shipping-fast nav-icon"></i>
            <p>Sedang Berlangsung</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../../index2.html" class="nav-link text-secondary">
            <i class="fa fa-history nav-icon"></i>
            <p>Riwayat</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="../../index2.html" class="nav-link text-secondary">
        <i class="fa fa-plus-square nav-icon"></i>
        <p>Tambah Surat Jalan</p>
      </a>
    </li>
    <li class="nav-header">MANAJEMEN</li>
    <li class="nav-item">
      <a href="#" class="nav-link text-secondary">
        {{-- <i class="nav-icon fa fa-people-carry"></i> --}}
        <i class="nav-icon fa fa-hard-hat"></i>
        <p>Supir & Transport</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-secondary">
        <i class="nav-icon fa fa-users"></i>
        <p>Data Admin</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-secondary">
        <i class="nav-icon fa fa-sitemap"></i>
        <p>Data Pool</p>
      </a>
    </li>

  </ul>
</nav>
