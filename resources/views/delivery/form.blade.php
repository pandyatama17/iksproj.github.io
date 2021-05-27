@extends('layouts.wrapper')
@section('title','Form Rekapan')
@section('content')
<form class="form" action="@if($method == 'new'){{route('submit_delivery')}}@elseif($method=='edit') {{route('update_delivery')}} @endif" method="post">
  @csrf
  @if ($method == 'edit')
    <input type="hidden" name="delivery_id" value="{{$delivery->id}}">
  @endif
<div class="row">
  <div class="offset-lg-2 col-lg-8 col-md-12 col-sm-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          @if ($method == 'edit')
            Edit Rekap
          @else
            Form Rekap Baru
          @endif
        </h3>
      </div>
      <div class="card-body row">
        <div class="col-lg-6 col-sm-12">
          <div class="form-group">
            <label>Kode Tongkang</label>
            <input type="text" name="code" @if ($method == 'edit') value="{{$delivery->code}}" @endif id="codeTxt" class="form-control" placeholder="Kode/Nama Tongkang">
          </div>
          <div class="form-group">
            <label>Petugas</label>
            <input type="hidden" name="admin" @if ($method == 'edit') value="{{$delivery->admin}}" @else value="{{Auth::user()->id}}" @endif class="form-control">
            <input type="text" readonly @if ($method == 'edit') value="{{\App\User::find($delivery->admin)->name}}" @else value="{{Auth::user()->name}}" @endif class="form-control">
          </div>
          @if (Auth::user()->role == 0 )
            <div class="form-group">
              <label>Pool</label>
              <select class="form-control" name="pool_id">
                <option @if (Auth::user()->id < 2 && $method=="new") selected @endif disabled>Pilih pool...</option>
                @foreach (App\Pool::all() as $pool)
                  <option @if ((Auth::user()->id >=2 && Auth::user()->pool_id == $pool->id) || ($method == "new" && $delivery->pool_id == $pool->id))selected @endif value="{{$pool->id}}">{{$pool->name}}</option>
                @endforeach
              </select>
            </div>
          @else
            <input type="hidden" name="pool_id" @if ($method == "edit") value="{{$delivery->pool_id}}" @else value="{{Auth::user()->pool_id}}" @endif>
          @endif
          <div class="form-group">
            <label>Tanggal</label>
            <input type="text" name="date" @if($method=="edit") value="{{\Carbon\Carbon::parse($delivery->created_at)->format('d-m-Y')}}" @endif class="form-control datepicker" autocomplete="off" placeholder="Tanggal Rekap" readonly>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="form-group">
            <label>Muatan</label>
            <input type="text" name="freight_load" @if($method=="edit") value="{{$delivery->freight_load}}" @endif class="form-control" id="FreightLoadTxt" data-header="2" autocomplete="off" placeholder="Muatan Barang">
          </div>
          <div class="form-group">
            <label>Customer</label>
            <input type="text" name="customer_name" @if($method=="edit") value="{{$delivery->customer_name}}" @endif class="form-control" id="customerTxt" data-header="3" autocomplete="off" placeholder="Nama Customer">
          </div>
          <div class="form-group">
            <label>Pengirim</label>
            <input type="text" name="sender_name" id="senderTxt" @if($method=="edit") value="{{$delivery->sender_name}}" @endif class="form-control" placeholder="Nama Pengirim">
          </div>
          <div class="form-group">
            <label>Penerima</label>
            <input type="text" name="recipient_name" id="recipientTxt" @if($method=="edit") value="{{$delivery->recipient_name}}" @endif class="form-control" placeholder="Nama Penerima">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" name="button" class="btn btn-success">
          <i class="fa fa-save"></i>
          @if ($method == 'edit')
            Update Rekap
          @else
            Buat Rekap
          @endif
        </button>
      </div>
    </div>
  </div>
  {{-- <div class="col-lg-4 col-md-12 col-sm-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Ajuan Baru</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label>Kode Ajuan</label>
          <input type="text" name="code" value="" class="form-control">
        </div>
        <div class="form-group">
          <label>Petugas</label>
          <input type="hidden" name="admin" value="{{Auth::user()->id}}" class="form-control">
          <input type="text" readonly value="{{Auth::user()->name}}" class="form-control">
        </div>
        <hr>
        <div class="form-group">
          <label>Nama Customer</label>
          <input type="text" name="customer_name" value="" class="form-control">
        </div>
        <div class="form-group">
          <label>Telp. Customer</label>
          <input type="text" name="customer_phone" value="" class="form-control">
        </div>
        <div class="form-group">
          <label>Alamat Customer</label>
          <textarea name="customer_address" class="form-control" rows="4" cols="40"></textarea>
        </div>
        <div class="form-group">
          <label>Muatan</label>
          <input type="text" name="freight_load" value="" class="form-control">
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8 col-sm-12">
    <div class="row">
      <div class="col-lg-6 col-sm-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Informasi Pengirim</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama pengirim</label>
              <input type="text" name="sender_name" value="" class="form-control">
            </div>
            <div class="form-group">
              <label>Telp. pengirim</label>
              <input type="text" name="sender_phone" value="" class="form-control">
            </div>
            <div class="form-group">
              <label>Alamat pengirim</label>
              <textarea name="sender_address" class="form-control" rows="4" cols="40"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-sm-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Informasi Penerima</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Nama Penerima</label>
              <input type="text" name="recipient_name" value="" class="form-control">
            </div>
            <div class="form-group">
              <label>Telp. Penerima</label>
              <input type="text" name="recipient_phone" value="" class="form-control">
            </div>
            <div class="form-group">
              <label>Alamat Penerima</label>
              <textarea name="recipient_address" class="form-control" rows="4" cols="40"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-footer">
            <button type="submit" name="button" class="btn btn-primary">Buat Surat</button>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
</div>
</form>

@endsection
