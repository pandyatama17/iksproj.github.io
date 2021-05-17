<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Data sopir transport {{$transport->name}}</h3>
  </div>
  <div class="card-body">
    <table class="table table-striped" id="driversTable">
      <thead>
        <th>Nama</th>
        <th>No. Plat Kendaraan</th>
        {{-- <th>&nbsp;</th> --}}
      </thead>
      <tbody>
        @foreach ($drivers as $dr)
          <tr>
            <td>{{$dr->name}}</td>
            <td>
              {{$dr->license_plate_no}}
              <span class="float-right">
                <a href="#">
                  <i class="fa fa-edit"></i> | Edit
                </a>
              </span>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-primary" id="addDriverButton">
      <i class="fa fa-user-plus"></i> Tambah Sopir
    </button>
  </div>
</div>
<script type="text/javascript">
$('#driversTable').DataTable();
$("#addDriverButton").on('click',function(event)
{
  $("#addDriverModal").modal('show');
});
</script>
