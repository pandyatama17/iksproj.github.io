@extends('layouts.wrapper')
@section('title','Data Master')
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Tongkang per {{Carbon\Carbon::now()->format('d F Y')}}</h3>
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
      <table class="table table-bordered table-striped datatable-responsive">
        <thead class="bg-secondary">
          <th>Tongkang</th>
          <th>Tanggal</th>
          <th>Customer</th>
          <th class="none">Pool</th>
          <th class="none">Pengirim</th>
          <th class="none">Penerima</th>
          <th>Muatan</th>
          <th class="none">Tonase</th>
          <th>Rit</th>
          <th>Tindakan</th>
        </thead>
        <tbody>
          @foreach ($data as $d)
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
                <a href="{!! route('show_delivery',$d->id) !!}">
                  <i class="fa fa-search"></i> | Data Surat Jalan
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Footer
    </div>
    <!-- /.card-footer-->
  </div>
@endsection
