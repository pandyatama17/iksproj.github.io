@extends('layouts.wrapper')
@section('title','Tutup Buku')
@section('content')
  <div class="row">
    <div class="col-12 col-lg-3">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tutup Buku</h3>
        </div>
        <form class="" action="{{route('get_journal')}}" method="post" id="journalForm">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label>Pilih Pool</label>
              @foreach ($pools as $pool)
                <div class="inline-group">
                  <input type="checkbox" class="icheck" name="pool-{{$pool->id}}" value="true">
                  <label for="pool-{{$pool->id}}">Pool {{$pool->name}}</label>
                </div>
              @endforeach
            </div>
            <div class="form-group">
              <label>Tanggal</label>
              <input type="text" id="daterange" class="form-control" name="dates" value="">
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">
              <i class="fa fa-search"></i> Lihat Data
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-12 col-lg-9" id="journalCol">

    </div>
  </div>
@endsection
