@extends('layouts.wrapper')
@section('title','data pool')
@section('content')
  <div class="card card-solid">
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
                    <h2 class="lead"><b>Pool {{$pool->name}}</b></h2>
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
  </div>
@endsection
