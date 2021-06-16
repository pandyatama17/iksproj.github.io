@extends('layouts.wrapper')
@section('title','Tongkang '.$data->code)
@section('content')
  <style media="screen">
  .input-group .select2-selection__rendered {
  line-height: 110% !important;
  }
  .input-group .select2-container .select2-selection--single {
    height: 110% !important;
  }
  .input-group .select2-selection__arrow {
    height: 110% !important;
  }
  </style>
  <div class="card card-primary">
    <div class="card-header">
      <h5 class="card-title">Tongkang {{$data->code}} ({{$data->pool}})</h5>
      <div class="card-tools">
        @if ($data->show_available)
          <button type="button" class="btn btn-tool bg-navy" {{--data-toggle="modal" data-target="#addDOModal"--}} id="addDOButton" >
            <i class="fas fa-plus"></i> <span class="d-none d-md-inline">Tambah Surat</span>
          </button>
          <a href="{{route('edit_delivery',$data->id)}}" class="btn btn-tool bg-warning" data-toggle="" data-target="">
            <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit Rekap</span>
          </a>
        @endif
        <a type="button" class="btn btn-tool bg-success" href="{{route('export_delivery',$data->id)}}">
          <i class="fas fa-file-excel"></i> <span class="d-none d-md-inline">Unduh Excel</span>
        </a>
        {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button> --}}
      </div>
    </div>
    <div class="card-body">
      <div class="container-fluid d-none d-md-block">
        {{-- <div class="row">
          <div class=" offset-lg-1 offset-sm-0 offset-xs-0 col-lg-2 col-sm-4 col-xs-4"><h5>Tongkang</h5></div>
          <div class="col-lg-9 col-sm-6"><h5>: {{$data->code}}</h5></div>
        </div> --}}
        <div class="row">
          <div class=" offset-lg-1 offset-sm-0 offset-xs-0 col-lg-2 col-sm-4 col-xs-4"><h5>Customer</h5></div>
          <div class="col-lg-9 col-sm-6"><h5>: {{$data->customer_name}}</h5></div>
        </div>
        <div class="row">
          <div class="offset-lg-1 col-sm-4 col-lg-2 col-xs-4 col-md-4"><h5>Muatan</h5></div>
          <div class="col-lg-9 col-sm-6 col-md-6"><h5>: {{$data->freight_load}}</h5></div>
        </div>
        <div class="row">
          <div class="offset-1 col-2"><h5>Tanggal</h5></div>
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
      </div>
      <div class="d-xs-block d-sm-block d-lg-none">
        <div class="row">
          <div class="col-3"><b>Customer</b></div>
          <div class="col-9"><b>:</b> {{$data->customer_name}}</div>
        </div>
        {{-- <div class="row">
          <div class="col-3"><b>Tongkang</b></div>
          <div class="col-9"><b>:</b> {{$data->code}}</div>
        </div> --}}
        <div class="row">
          <div class="col-3"><b>Muatan</b></div>
          <div class="col-9"><b>:</b> {{$data->freight_load}}</div>
        </div>
        <div class="row">
          <div class="col-3"><b>Tanggal</b></div>
          <div class="col-9"><b>:</b> {{Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}</div>
        </div>
        <div class="row">
          <div class="col-3"><b>Asal</b></div>
          <div class="col-9"><b>:</b> {{$data->sender_name}}</div>
        </div>
        <div class="row">
          <div class="col-3"><b>Tujuan</b></div>
          <div class="col-9"><b>:</b> {{$data->recipient_name}}</div>
        </div>
        <div class="row">
          <div class="col-3"><b>Petugas</b></div>
          <div class="col-9"><b>:</b> {{$data->admin}}</div>
        </div>
        <div class="clearfix"></div>
        <br>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            {{-- <tr>
              <th class="align-middle" style="width:15%" rowspan="2">No. Surat</th>
              <th class="align-middle" rowspan="2">Tonase</th>
              <th class="align-middle" rowspan="2">Pengambilan</th>
              <th colspan="2" class="text-center">Blending</th>
              <th rowspan="2" class="text-center"  style="width:2%; border:none!important; background:#fff!important"></th>
            </tr>
            <tr>
              <th>Nama Sopir</th>
              <th>No. Plat</th>
              <th>Nama Angkutan</th>
              <th>Kasbon UJ</th>
              <th>Tonase</th>
            </tr> --}}
            <tr>
              <th>No. Surat</th>
              {{-- <th>Tonase</th> --}}
              <th>Kasbon UJ</th>
              <th>No. Polisi</th>
              <th>Nama Sopir</th>
              <th>Angkutan</th>
              <th>Asal Bl.</th>
              <th>UJ Bl.</th>
              {{-- <th>Tonase Bl.</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($details as $d)
              <tr>

                <td>
                  <b>{{$d->do_number}}</b>
                  {{-- @if ($d->blending_origin)
                    <small>({{$d->blending_origin}})</small>
                  @endif --}}
                </td>
                {{-- <td>{{Carbon\Carbon::parse($d->date)->format('d-m-Y')}}</td> --}}
                {{-- <td max-width="100%" style="white-space: nowrap;">
                  {{$d->tonnage}} Kg. --}}
                  {{-- @if ($d->blending_origin)
                  <small>({{$d->tonnage - $d->blending_tonnage}}Kg. + {{$d->blending_tonnage}}Kg.)</small>
                @endif --}}
              {{-- </td> --}}
              <td max-width="100%" style="white-space: nowrap;">{{rupiah($d->fare)}}</td>
              <td style="white-space:nowrap">{{$d->license_plate_no}}</td>
                <td max-width="100%" style="white-space: nowrap;">
                  @if ($d->driver_name)
                    {{$d->driver_name}}
                  @else
                    {{$d->driver}}
                  @endif
                </td>
                <td>{{App\VehicleOwner::find(App\Driver::find($d->driver_id)->owner_id)->name}}</td>
                {{-- <td>{{$d->transport}}</td> --}}
                @if ($d->blending_origin)
                  <td max-width="100%" style="white-space: nowrap;">{{$d->blending_origin}}</td>
                  {{-- <td>{{$d->blending_destination}}</td> --}}
                  <td max-width="100%" style="white-space: nowrap;">{{rupiah($d->blending_fare)}}</td>
                  {{-- <td>{{rupiah($d->blending_fare2)}}</td> --}}
                  {{-- <td>{{$d->blending_tonnage}}Kg.</td> --}}
                @else
                  <td colspan="2" class="text-center">-</td>
                @endif
                @if ($data->show_available)
                  <td style="{{--border:none!important;--}} background:#fff!important">
                    <button type="button" class="btn btn-link text-orange editDO" style="padding:0px" data-doid="{{$d->id}}">
                      <i class="fa fa-edit"></i>
                    </button>
                  </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer d-block d-md-none">
      @if ($data->show_available)
        <button type="button" class="btn bg-navy" data-toggle="modal" data-target="#addDOModal">
          <i class="fas fa-plus"></i> Tambah Surat
        </button>
      @endif
      <button type="button" class="btn bg-success" onclick="Swal.fire('belum ada')">
        <i class="fas fa-file-excel"></i> Import Excel
      </button>
    </div>
    <!-- /.card-footer-->
  </div>
  {{-- modal --}}
  <input type="hidden" id="indexDOCount" value="{{count($details)}}">
  <div class="modal fade" id="addDOModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form class="form" action="{{route('submit_do')}}" method="post">
        @csrf
        <input type="hidden" name="delivery_id" value="{{$data->id}}">
        <input type="hidden" name="do_id" id="doIDTxt">
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
                <label for="">Nama Tongkang (Tug Boat/Bargain)</label>
                <input type="text" class="form-control" value="{{$data->code}}" readonly id="codeTxt">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Customer</label>
                <input type="text" class="form-control" value="{{$data->customer_name}}" readonly id="customerTxt">
              </div>
            </div>
          </div>
          <div class="row">
            <div class=" col-lg-3 col-5">
              <div class="form-group">
                <label for="">No. Surat jalan</label>
                <input type="text" class="form-control" name="do_number" data-code="{{$data->code}}"  id="DONumberTxt" value="{{$data->code}}">
              </div>
            </div>
            {{-- <div class="col-lg-4 col-6">
              <div class="form-group">
                <label for="">Blendingan Surat</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"style="height:110%">
                      <input type="checkbox" class="icheck" id="blendingCheck">
                    </span>
                  </div>
                  <select class="select2 form-control" name="blending_ref_id" id="blendingRefSelect" disabled>
                    <option selected disabled>SJ Referensi..</option>
                    @foreach ($details as $do)
                      <option value="{{$do->id}}">{{$do->do_number}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div> --}}
            {{-- <div class="col-4">
              <div class="form-group">
                <label for="">Tanggal</label>
                <input type="text" class="form-control datepicker" name="date" id="dateTxt" autocomplete="off">
              </div>
            </div> --}}
            {{-- <div class="col-lg-3 col-5">
              <div class="form-group">
                <label for="">Tonase</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="tonnage" autocomplete="off" id="tonnageTxt">
                  <div class="input-group-append">
                    <span class="input-group-text">Kg.</span>
                  </div>
                </div>
              </div>
            </div> --}}
            <input type="hidden" class="form-control" name="tonnage" autocomplete="off" id="tonnageTxt" value="0">

            <div class="col-5 col-lg-3">
              <div class="form-group">
                <br>
                <input type="checkbox" class="icheck" id="blendingCheck" name="blending">
                <label for="blendingCheck">Blending</label>
                </div>
            </div>
          </div>
          <div id="blendingCol">
            <hr>
            <div class="row">
              {{-- <div class="col-lg-4 col-6">
                <div class="form-group">
                  <label for="">Tujuan Blending</label>
                  <input type="text" class="form-control" name="blending_destination">
                </div>
              </div> --}}
              <div class=" col-lg-4 col-6">
                <div class="form-group">
                  <label for="">Stockpile</label>
                  <input type="text" class="form-control" name="blending_origin" id="blendingOriginTxt">
                </div>
              </div>
              {{-- <div class="col-lg-3 col-5">
                <div class="form-group">
                  <label for="">Tonase Blending</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="blending_tonnage" id="blendingTonnageTxt">
                    <div class="input-group-append">
                      <span class="input-group-text">Kg.</span>
                    </div>
                  </div>
                </div>
              </div> --}}
              <input type="hidden" class="form-control" name="blending_tonnage" id="blendingTonnageTxt">
            {{-- </div>
            <div class="row"> --}}
              <div class="col-7 col-lg-4">
                <div class="form-group">
                  <label>UJ Blending</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="blending_fare" autocomplete="off" id="blendingFareTxt">
                    <div class="input-group-append">
                      <span class="input-group-text">,-</span>
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="col-7 col-lg-4">
                <div class="form-group">
                  <label>Tarif Blending</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="blending_fare2" autocomplete="off">
                    <div class="input-group-append">
                      <span class="input-group-text">,-</span>
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-4" id="driverCol">
              <label for="">Mobil</label>
              <br>
              {{-- <select class="select2 form-control" style="width:100%" disabled>
              <option selected disabled> Pilih mobil... </option>
            </select> --}}
            <select class="select2 form-control" id="carSelect" data-placeholder="Pilih Mobil...">
              <option selected disabled>Pilih Mobil...</option>
              @foreach (\App\Driver::all() as $driver)
                <option value="{{$driver->id}}">{{$driver->license_plate_no}}</option>
              @endforeach
            </select>
          </div>
            <div class="col-3">
              <label for="">Angkutan</label>
              <br>
              {{-- <select class="select2 form-control" style="width:100%" id="transportSelect">
                <option selected disabled> Pilih angkutan... </option>
                @foreach ($transports as $tr)
                  <option value="{{$tr->id}}">{{$tr->name}}</option>
                @endforeach
              </select> --}}
              <input type="text" class="form-control" id="transportTxt" readonly>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label>Sopir</label>
                <input type="hidden" id="driverIDHidTXT" name="driver_id">
                <input type="hidden" id="driverLicenseHidTXT" name="license_plate_no">
                <input type="text" readonly value="-" id="driverNameTxt" name="driver_name" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            {{-- <div class="col-8">
            </div> --}}
            <div class="col-7 col-lg-5">
              <div class="form-group">
                <label>Kasbon UJ</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="number" class="form-control" name="fare" autocomplete="off" id="fareTxt">
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
