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
                <a href="#" class="text-secondary editDriverButton" data-driverid="{{$dr->id}}" data-name="{{$dr->name}}" data-licenseplate="{{$dr->license_plate_no}}">
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
    $("#driverForm").attr('action','{{route('submit_driver')}}');
    $("#driverModalTitle").html('Tambah Sopir');
    $("#txtDriverID").val('');
    $("#txtDriverName").val('');
    $("#txtDriverplate").val('');
    $("#addDriverModal").modal('show');
});
$(".editDriverButton").on('click',function(event)
{
    $("#driverForm").attr('action','{{route('update_driver')}}');
    $("#driverModalTitle").html('Edit Sopir');
    $("#txtDriverID").val($(this).data('driverid'));
    $("#txtDriverName").val($(this).data('name'));
    $("#txtDriverPlate").val($(this).data('licenseplate'));
    $("#addDriverModal").modal('show');
});
</script>
