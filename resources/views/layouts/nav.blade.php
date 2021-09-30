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
    <li class="nav-header">REKAPAN SURAT</li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-ship text-success"></i>
        <p>
          Rekap Tongkang
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        {{-- <li class="nav-item">
          <a href="{{route('master_data')}}" class="nav-link url-redirect">
            <i class="fa fa-archive nav-icon"></i>
            <p>Data Master</p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="{{route('deliveries_wstat', 1)}}" class="nav-link url-redirect">
            <i class="fa fa-shipping-fast nav-icon text-lime"></i>
            <p>Rekapan Aktif</p>
          </a>
        </li>
        @if (Auth::user()->role < 2)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-sitemap text-purple"></i>
              <p>
                Per Dermaga
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach (\App\Pool::all() as $pool)
                <li class="nav-item">
                  <a href="{{route('deliveries_data',$pool->id)}}" class="nav-link url-redirect">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{$pool->name}}</p>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif
        <li class="nav-item">
          <a href="{{route('deliveries_wstat', 0)}}" class="nav-link url-redirect">
            <i class="fa fa-history nav-icon text-secondary"></i>
            <p>Rekap Non-Aktif (Riwayat)</p>
          </a>
        </li>
        <hr class="bg-secondary">
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-clipboard-check"></i>
            <p>
              Status
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('deliveries_wstat', 1)}}" class="nav-link url-redirect">
                <i class="fa fa-shipping-fast nav-icon"></i>
                <p>Sedang Berlangsung</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('deliveries_wstat', 0)}}" class="nav-link url-redirect">
                <i class="fa fa-history nav-icon"></i>
                <p>Riwayat</p>
              </a>
            </li>
          </ul>
        </li> --}}
      </ul>
    </li>
    <li class="nav-item">
      <a href="{{route('new_delivery')}}" class="nav-link url-redirect">
        <i class="fa fa-plus-square nav-icon text-primary"></i>
        <p>Tambah Rekap</p>
      </a>
      <hr class="bg-secondary">
    </li>
    <li class="nav-header">SURAT JALAN</li>
    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-mail-bulk text-lightblue"></i>
        <p>
          Data Surat jalan
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{route('do_master_data')}}" class="nav-link url-redirect">
            <i class="fa fa-archive nav-icon text-info"></i>
            <p>Data Master</p>
          </a>
        </li>
        @if (Auth::user()->role < 2)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-sitemap text-purple"></i>
              <p>
                Per Dermaga
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach (\App\Pool::all() as $pool)
                <li class="nav-item">
                  <a href="{{route('do_data',$pool->id)}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{$pool->name}}</p>
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endif
        {{-- <hr class="bg-secondary"> --}}
      </ul>
      <hr class="bg-secondary">
    </li>
    {{-- <li class="nav-item">
      <a href="{{route('new_do')}}" class="nav-link url-redirect">
        <i class="fa fa-plus-square nav-icon"></i>
        <p>Tambah Surat Jalan</p>
      </a>
    </li> --}}

    @if (Auth::user()->role < 2)
      <li class="nav-header">MANAJEMEN</li>
      <li class="nav-item">
        <a href="{{route('show_transports')}}" class="nav-link url-redirect">
          {{-- <i class="nav-icon fa fa-people-carry"></i> --}}
          <i class="nav-icon fa fa-hard-hat text-yellow"></i>
          <p>Sopir & Transport</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('show_users')}}" class="nav-link url-redirect">
          <i class="nav-icon fa fa-users text-indigo"></i>
          <p>Data Admin</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('show_pools')}}" class="nav-link url-redirect">
          <i class="nav-icon fa fa-sitemap text-purple"></i>
          <p>Dermaga</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('show_journal')}}" class="nav-link url-redirect">
          <i class="nav-icon fa fa-book"></i>
          <p>Jurnal</p>
        </a>
        <hr class="bg-secondary">
      </li>
    @endif
    <li class="nav-header">USER</li>
    <li class="nav-item">
      <a href="{{route('logout')}}" class="nav-link url-redirect">
        <i class="nav-icon fa fa-sign-out-alt"></i>
        <p>Log Out</p>
      </a>
    </li>
  </ul>
</nav>
