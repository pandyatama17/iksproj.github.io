@extends('layouts.wrapper')
@section('title','Data Dermaga')
@section('content')
  <div class="card card-solid">
    {{-- <div class="card-header">
      <div class="card-tools">
        <a href="#" class="btn bg-navy" data-toggle="tooltip" data-tooltip="Tambah Dermaga" name="button">
          <i class="fa fa-plus"></i>
        </a>
      </div>
    </div> --}}
    <div class="card-body pb-0">
      <div class="row">
          @foreach ($data as $pool)
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                {{-- Pool {{$pool->name}} --}}
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b> {{$pool->name}}</b></h2>
                    <p class="text-muted text-sm"><b>Petugas: </b>
                      @foreach ($users as $user)
                        @if ($user->pool_id == $pool->id)
                          {{$user->name}} <br>
                        @endif
                      @endforeach
                      {{-- <ul>
                        @foreach ($users as $user)
                          @if ($user->pool_id == $pool->id)
                            <li>{{$user->name}}</li>
                          @endif
                        @endforeach
                      </ul> --}}
                    </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: {{$pool->address}}</li>
                      <li class="small phoneCol" ><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Telp. : {{$pool->phone}}</li>
                    </ul>
                  </div>
                  {{-- <div class="col-5 text-center">
                    <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                  </div> --}}
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  {{-- <a href="#" class="btn btn-sm bg-teal">
                    <i class="fas fa-comments"></i>
                  </a> --}}
                  <a href="{{route('deliveries_data',$pool->id)}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-clipboard-list"></i> Rekapan Pool
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
      </div>
    </div>
    <div class="card-footer">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#poolModal">
        <i class="fa fa-plus"></i> Tambah Dermaga
      </button>
    </div>
  </div>

  <div class="modal fade" id="poolModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form class="form" method="post" id="transportForm" action="{{route('submit_pool')}}">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Dermaga</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-4">
                <label>Jenis</label>
              </div>
              <div class="col-4">
                <label><input type="radio" name="poolKind" value="Dermaga" checked><span style="margin-top:-10px;">Dermaga</span> </label>
              </div>
              <div class="col-4">
                <label><input type="radio" name="poolKind" value="Stockpile"><span style="margin-top:-10px;">Stockpile</span> </label>
              </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
              <div class="col-4">
                <label id="typeNameLabel">Nama Dermaga</label>
              </div>
              <div class="col-8">
                <input type="text" name="name" class="form-control pull-right" id="txtPoolName" value="Dermaga ">
              </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
              <div class="col-4">
                <label>No. Telp</label>
              </div>
              <div class="col-8">
                <input type="number" name="phone" class="form-control pull-right" id="txtPoolName">
              </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
              <div class="col-4">
                <label>Alamat</label>
              </div>
              <div class="col-8">
                <textarea name="address" class="form-control pull-right"></textarea>
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
