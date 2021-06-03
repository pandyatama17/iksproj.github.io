@extends('layouts.wrapper')
@section('title', 'Data Petugas & Admin')
@section('content')
  <div class="row">
    <div class="col-12 col-lg-10 offset-lg-1">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">@yield('title')</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped datatable-responsive">
            <thead>
              <th>#</th>
              <th>Nama</th>
              <th>e-mail</th>
              <th>Pool / Tanggung Jawab</th>
              <th>Tindakan</th>
            </thead>
            <tbody>
              @foreach ($data as $index => $u)
                <tr>
                  <td>{{$index + 1}}</td>
                  <td>{{$u->name}}</td>
                  <td>{{$u->email}}</td>
                  <td>
                    @if ($u->role > 1)
                      <a href="#">
                        <span class="badge @if($u->pool_id == 1)badge-info @else bg-purple @endif">
                          Pool {{\App\Pool::find($u->pool_id)->name}}
                        </span>
                      </a>
                    @elseif ($u->role == 0)
                      <span class="badge badge-danger">Superadmin</span>
                    @else
                      <span class="badge badge-warning">Admin</span>
                    @endif
                  </td>
                  <td>
                    @if ($u->role > 0 )
                      <a href="#" class="text-secondary triggerEditUserInfo" data-id="{{$u->id}}" data-name="{{$u->name}}" data-email="{{$u->email}}" data-pool={{$u->pool_id}}>
                        <i class="fa fa-info-circle"></i> | Edit Informasi
                      </a> <br>
                    @endif
                    {{-- <a href="#"  class="text-secondary">
                      <i class="fa fa-key"></i> | Edit Password
                    </a> --}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="userInfoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Informasi <span id="titleUserName"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="{{route('update_user')}}" method="post">
        @csrf
        <input type="hidden" name="user_id" id="txtHidUser">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" id="txtUserName" value="">
          </div>
          <div class="form-group">
            <label>email</label>
            <input type="email" name="email" class="form-control" id="txtUserEmail" value="">
          </div>
          <div class="form-group">
            <label>Pool</label>
            <select class="select2 form-control" name="pool_id" id="selectPool">
              <option selected disabled>pilih pool...</option>
              @foreach (\App\Pool::all() as $pool)
                <option value="{{$pool->id}}">{{$pool->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
