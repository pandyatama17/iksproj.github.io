@extends('layouts.wrapper')
@section('title','Data '.$pool)
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data {{$pool}} Tongkang per {{Carbon\Carbon::now()->format('d F Y')}}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped" id="delivery-master-table">
        <thead class="bg-secondary">
          <th>Tongkang</th>
          <th>Tanggal</th>
          <th>Customer</th>
          <th class="none">Dermaga</th>
          <th class="none">Asal</th>
          <th class="none">Tujuan</th>
          <th>Muatan</th>
          <th class="none">Tonase</th>
          <th>Ritase</th>
          <th>Tindakan</th>
        </thead>
        <tbody>
          {{-- @foreach ($data as $d)
            <tr>
              <td><b>{{$d->code}}</b></td>
              <td>{{Carbon\Carbon::parse($d->created_at)->format('d-m-Y')}}</td>
              <td>{{$d->customer_name}}</td>
              <td>{{$d->pool}}</td>
              <td>{{$d->sender_name}}</td>
              <td>{{$d->recipient_name}}</td>
              <td>{{$d->freight_load}}</td>
              <td>{{array_sum(App\DeliveryOrder::where('delivery_id',$d->id)->pluck('tonnage')->toArray())}} Kg.</td>
              <td><span class="badge badge-secondary">{{count(App\DeliveryOrder::where('delivery_id',$d->id)->get())}} Rit</span> </td>
              <td>
                <a href="{!! route('show_delivery',$d->id) !!}" class="url-redirect">
                  <i class="fa fa-search"></i> | Data Surat Jalan
                </a>
              </td>
            </tr>
          @endforeach --}}
        </tbody>
      </table>
    </div>
    <!-- /.card-footer-->
  </div>
@endsection
