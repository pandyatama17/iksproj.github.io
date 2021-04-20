@extends('layouts.wrapper')
@section('title','Data Surat Jalan '.$data->code)
@section('content')
  <div class="card card-primary">
    <div class="card-header">
      <h5 class="card-title">{{$data->code}}</h5>
      <div class="card-tools">
        <button type="button" class="btn btn-tool bg-navy" data-toggle="modal" data-target="#addDOModal">
          <i class="fas fa-plus"></i> Tambah Surat
        </button>
        {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button> --}}
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-1"></div>
        <div class="col-2"><h5>Customer</h5></div>
        <div class="col-9"><h5>: {{$data->customer_name}}</h5></div>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-2"><h5>Muatan</h5></div>
        <div class="col-9"><h5>: {{$data->freight_load}}</h5></div>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-2"><h5>Tanggal</h5></div>
        <div class="col-9"><h5>: {{Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}</h5></div>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-2"><h5>Asal</h5></div>
        <div class="col-9"><h5>: {{$data->sender_name}}</h5></div>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-2"><h5>Tujuan</h5></div>
        <div class="col-9"><h5>: {{$data->recipient_name}}</h5></div>
      </div>
      <div class="row">
        <div class="col-1"></div>
        <div class="col-2"><h5>Petugas</h5></div>
        <div class="col-9"><h5>: {{$data->admin}}</h5></div>
      </div>
      <table class="table table-bordered">
        <thead>
          <th>No. SJ</th>
          <th>tgl.</th>
          <th>Sopir</th>
          <th>No. Plat</th>
          <th>Tonase</th>
          <th>Angkutan</th>
        </thead>
        <tbody>
          @foreach ($details as $d)
            <tr>
              <td>{{$d->do_number}}</td>
              <td>{{Carbon\Carbon::parse($d->date)->format('d-m-Y')}}</td>
              <td>{{$d->driver}}</td>
              <td>{{$d->plate}}</td>
              <td>{{$d->tonnage}} Kg.</td>
              <td>{{App\VehicleOwner::find(App\Driver::find($d->driver_id)->owner_id)->name}}</td>
              {{-- <td>{{$d->transport}}</td> --}}
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer">
      Footer
    </div> --}}
    <!-- /.card-footer-->
  </div>
  {{-- modal --}}
  <div class="modal fade" id="addDOModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form class="form" action="{{route('submit_do')}}" method="post">
        @csrf
        <input type="hidden" name="delivery_id" value="{{$data->id}}">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Surat Jalan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="">Surat Ajuan</label>
                <input type="text" class="form-control" value="{{$data->code}}" readonly>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Customer</label>
                <input type="text" class="form-control" value="{{$data->customer_name}}" readonly>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-5">
              <div class="form-group">
                <label for="">No. Surat jalan</label>
                <input type="text" class="form-control" name="do_number" value="{{$data->code}}">
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="text" class="form-control datepicker" name="date" autocomplete="off">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="">Tonase</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="tonnage" autocomplete="off">
                  <div class="input-group-append">
                    <span class="input-group-text">Kg.</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-4">
              <label for="">Angkutan</label>
              <br>
              <select class="select2 form-control" style="width:100%" id="transportSelect">
                <option selected disabled> Pilih angkutan... </option>
                @foreach ($transports as $tr)
                  <option value="{{$tr->id}}">{{$tr->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-5" id="driverCol">
              <label for="">Sopir</label>
              <br>
              <select class="select2 form-control" style="width:100%" disabled>
                <option selected disabled> Pilih sopir... </option>
              </select>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>No. Plat</label>
                <input type="text" readonly id="plateNumberTxt" value="-" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            {{-- <div class="col-8">
            </div> --}}
            <div class="col-5">
              <div class="form-group">
                <label>Tarip</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" class="form-control" name="fare" autocomplete="off">
                  <div class="input-group-append">
                    <span class="input-group-text">,-</span>
                  </div>
                </div>
              </div>
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
</div>
@endsection
