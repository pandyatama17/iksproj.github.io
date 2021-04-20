<script type="text/javascript">
$(document).ready(function()
{
  @if (Session::has('message'))
    toastr.{{Session::get('message-type')}}("{{Session::get('message')}}");
    Swal.fire("{{Session::get('message-title')}}","{{Session::get('message')}}","{{Session::get('message-type')}}");
  @endif
  $('.datatable-responsive').DataTable({
    "responsive": true
  });
  $(".datepicker").datepicker({
    format: "dd-mm-yyyy"
  });
  $(".select2").select2();
});
$("#transportSelect").on('change',function(event)
{
    const url = "/ajaxCall/drivers&transport=" + $(this).val();
    $.ajax({
      url : url,
      type: 'GET',
      dataType: 'HTML',
      success: function(response)
      {
        $("#driverCol").html(response);
      }
    })
});
</script>
