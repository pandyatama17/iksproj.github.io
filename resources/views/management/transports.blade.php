@extends('layouts.wrapper')
@section('title','Data Sopir Transportasi')
@section('content')
  <style media="screen">
  li.paginate_button.previous {
      display: inline;
  }

  li.paginate_button.next {
      display: inline;
  }

  li.paginate_button {
      display: none;
  }
  </style>
<div class="row">
  <div class="col-12 col-lg-4 col-xl-4">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">List Transportasi</h3>
      </div>
      <div class="card-body">
        <table class="table table-striped datatable-sm">
          <thead>
            <th>Transport Name</th>
            {{-- <th>Sopir</th> --}}
          </thead>
          <tbody>
            @foreach ($transports as $tr)
              <tr>
                <td>
                  {{$tr->name}}
                  <span class="float-right">
                    <a href="{{route('show_drivers_by',$tr->id)}}" class="ds-url" data-id="{{$tr->id}}">
                      <i class="fa fa-eye"></i>
                    </a>
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-8 col-xl-8" id="driversCol">

  </div>
</div>
<div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <form class="form" action="{{route('submit_driver')}}" method="post">
      <input type="hidden" name="owner_id" id="transportID" value="">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Surat Jalan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4">
            <label>Nama Sopir</label>
          </div>
          <div class="col-8">
            <input type="text" name="name" class="form-control pull-right">
          </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="row">
          <div class="col-4">
            <label>No. plat Kendaraan</label>
          </div>
          <div class="col-8">
            <input type="text" name="license_plate_no" class="form-control pull-right">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
  </div>
</div>
@endsection
