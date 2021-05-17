<!-- Notifications Dropdown Menu -->
@php
  $notif = 0;
  $deliveries = \App\Delivery::where('show_available',true)->get();
  $dos = \App\DeliveryOrder::all();
  $cds = count($deliveries);
  $cdos = count($dos);
  $notif += $cds + $cdos;
@endphp
<li class="nav-item dropdown">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <span class="badge badge-warning navbar-badge">{{$notif}}</span>
  </a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-item dropdown-header">{{$notif}} Notifications</span>
    <div class="dropdown-divider"></div>
    <a href="{{route('master_data')}}" class="dropdown-item">
      <i class="fas fa-envelope mr-2"></i> {{$cds}} Rekapan Sedang Berlangsung
      {{-- <span class="float-right text-muted text-sm">3 mins</span> --}}
    </a>
    <div class="dropdown-divider"></div>
    <a href="{{route('do_master_data')}}" class="dropdown-item">
      <i class="fas fa-users mr-2"></i> {{$cdos}} Data Surat Jalan
      {{-- <span class="float-right text-muted text-sm">12 hours</span> --}}
    </a>
    <div class="dropdown-divider"></div>
    {{-- <a href="#" class="dropdown-item">
      <i class="fas fa-file mr-2"></i> 3 new reports
      <span class="float-right text-muted text-sm">2 days</span>
    </a> --}}
    {{-- <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
  </div>
</li>
