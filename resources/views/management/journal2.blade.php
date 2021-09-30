@extends('layouts.wrapper')
@section('title','Jurnal')
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Jurnal</h3>
        </div>
        <div class="card-body">
          <div class="card-body table-responsive">
            <div class="row">
              <div class="col-md-6 col-lg-3">
                <label><i class="fa fa-tasks"> </i>  Pilih Data</label>
                <br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-sm btn-secondary" id="allDataBtn">
                    <input type="radio" name="options" id="journalSelectAll" autocomplete="off"> Semua
                  </label>
                  <label class="btn btn-sm bg-success">
                    <input type="radio" name="options"  id="journalSelectInactive" autocomplete="off"> Selesai
                  </label>
                  <label class="btn btn-sm bg-red">
                    <input type="radio" name="options" id="journalSelectActive" autocomplete="off"> Aktif
                  </label>
                </div>
              </div>
              <div class="col-md-6 col-lg-3">
                <label><i class="fa fa-trash"></i>  Tindakan</label>
                <br>
                <div class="btn-group" id="journalActionsWrapper">
                  <form class="" action="{{route('submit_journal')}}" method="post" id="journalForm">
                    @csrf
                    <input type="hidden" name="ids" id="deliveryIndexes">
                    <button type="button" class="btn btn-sm bg-warning" id="journalFormSubmit">
                      Hapus
                    </button>
                    <input type="submit" class="invisible" id="journalFormSubmitButton">
                  </form>
                  {{-- <button type="button" class="btn btn-sm bg-indigo" >
                    Hapus & Unduh
                  </button> --}}
                </div>
              </div>
              <div class="col-md-6 col-lg-5" id="journalExportsWrapper">
                <label><i class="fa fa-file-download"></i>  Export/Unduh Data</label>
              </div>
            </div>
            <br>
            <div class="clearfix"></div>
            <table class="table table-bordered" id="journalTable">
              {{-- <label style="position:absolute; padding-top:20px; margin-bottom: 0px!important;z-index:10001">Pilih Rekap</label>
              <div class="btn-group btn-group-toggle journalButtons" data-toggle="buttons">
                <label class="btn btn-sm btn-secondary active">
                  <input type="radio" name="options" id="journalSelectAll" autocomplete="off"> Semua
                </label>
                <label class="btn btn-sm bg-olive">
                  <input type="radio" name="options"  id="journalSelectInactive" autocomplete="off"> Selesai
                </label>
                <label class="btn btn-sm bg-maroon">
                  <input type="radio" name="options" id="journalSelectActive" autocomplete="off"> Aktif
                </label>
              </div>
              <br class="mobile-break">
              <label style="position:absolute; padding-top:20px;padding-left:15px; margin-bottom: 0px!important;z-index:10001">EXport/Unduh Rekap</label> --}}
              <thead>
                <th>Status</th>
                <th>Tongkang</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th class="never">#</th>
              </thead>
              <tbody>
                @foreach ($journal as $j)
                  @if ($j->show_available)
                      <tr class="active">
                        <td>
                          <p class="text-danger" data-toggle="tooltip" data-placement="top" title="REKAP AKTIF"><i class="fa fa-exclamation-circle"></i></p>
                        </td>
                      @else
                        <tr class="inactive">
                          <td>
                          <p class="text-success" data-toggle="tooltip" data-placement="top" title="REKAP NON-AKTIF"><i class="fa fa-check-circle"></i></p>
                        </td>
                      @endif
                    <td>{{$j->code}}</td>
                    <td>{{\Carbon\Carbon::parse($j->created_at)->formatLocalized('%Y-%m-%d')}}</td>
                    <td>{{$j->customer_name}}</td>
                    <td>{{$j->sender_name}}</td>
                    <td>{{$j->recipient_name}}</td>
                    <td>{{$j->id}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
