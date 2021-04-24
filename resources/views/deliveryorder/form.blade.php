@extends('layouts.wrapper')
@section('title','Tambah Surat Jalan')
@section('content')
<form class="form" action="{{route('submit_do2')}}" method="post">
  @csrf
<div class="row">
  <div class="col-lg-4 col-md-12 col-sm-12">
    <div class="card card-info" id="header-card">
      <div class="card-header">
        <h3 class="card-title">Form Rekapan</h3>
        <div class="card-tools">
          <button class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-window-minimize"></i></button>
        </div>
      </div>
      <div class="card-body row">
        <div class="col-12">
          <div class="form-group">
            <label>Kode Tongkang</label>
            {{-- <input type="text" name="code" id="codeTxt" class="form-control false-input" placeholder="Kode/Nama Tongkang"> --}}
            <select class="select2 form-control" name="delivery_id" id="deliverySelect">
              <option>Pilih Tongkang</option>
              @foreach ($deliveries as $d)
                <option value="{{$d->id}}">{{$d->code}}</option>
              @endforeach
            </select>
          </div>
          <hr>
          <div class="form-group">
            <label>Petugas</label>
            <input type="text" readonly id="adminTxtFalse" class="form-control false-input" placeholder="Nama Petugas">
          </div>
          <div class="form-group">
            <label>Pool</label>
            <input type="text" name="date" id="poolTxtFalse" class="form-control false-input" autocomplete="off" placeholder="Nama Pool" readonly>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input type="text" name="date" id="dateTxtFalse" class="form-control false-input" autocomplete="off" placeholder="Tanggal Rekap" readonly>
          </div>
          <div class="form-group">
            <label>Muatan</label>
            <input type="text" name="freight_load" id="freightLoadTxtFalse" class="form-control false-input" id="FreightLoadTxt" data-header="2" autocomplete="off" placeholder="Muatan Barang" readonly>
          </div>
          <div class="form-group">
            <label>Customer</label>
            <input type="text" name="customer_name" id="customerNameTxtFalse" class="form-control false-input" id="customerTxt" data-header="3" autocomplete="off" placeholder="Nama Customer" readonly>
          </div>
        </div>
      </div>
      <div class="card-footer">

      </div>
    </div>
  </div>
  <div class="col-lg-8 col-sm-12 col-xs-12" id="do-form-section">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Surat Jalan</h3>
        <div class="card-tools">
          <button class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-window-minimize"></i></button>
        </div>
      </div>
      <input type="hidden" id="DOIndex" name="rows" value="1">
      <div class="card-body" >
        <div id="do-form">

        </div>
      </div>
      <div class="card-footer" id="form-footer" style="display:none">
        <button type="button" class="btn btn-primary" id="addDOChild">
          <i class="fa fa-file-medical"></i> Tambah Surat Jalan
        </button>
        <button type="submit" name="button" class="btn btn-success float-right">
          <i class="fa fa-save"></i>
          Buat Surat Jalan
        </button>
      </div>
  </div>
</div>
</form>

@endsection
