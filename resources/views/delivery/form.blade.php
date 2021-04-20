@extends('layouts.wrapper')
@section('title','Tambah Ajuan Baru')
@section('content')
<form class="form" action="{{route('submit_delivery')}}" method="post">
  @csrf
<div class="row">
  <div class="col-lg-4 col-md-12 col-sm-12">
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
  </div>
</div>
</form>

@endsection
