@extends('layouts.wrapper')
@section('title','Data '.$pool)
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data {{$pool}} per {{Carbon\Carbon::now()->format('d F Y')}}</h3>
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
          <th>Sopir</th>
          <th>No. Plat</th>
          <th>Tonase</th>
          <th>Tarif</th>
          <th>Tindakan</th>
        </thead>
        <tbody>
          @foreach ($data as $do)
            <tr>
              <td><b>{{$do->code}}</b></td>
              <td>{{$do->driver}}</td>
              <td>{{$do->license_plate_no}}</td>
              <td>{{$do->tonnage}} Kg.</td>
              <td>{{rupiah($do->fare)}}</td>
              <td>
                <a href="{{route('show_delivery',$do->delivery_id)}}" class="url-redirect">
                  <i class="fa fa-file-alt"></i> | Rekapan
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
