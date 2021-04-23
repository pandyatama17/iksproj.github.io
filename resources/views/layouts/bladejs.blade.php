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
$("#addDOModal").on('shown.bs.modal',function() {
  var donum = $("#DONumberTxt");
  const lastIndex = $("#indexDOCount").val();
  var newIndex = parseInt(lastIndex) + 1;
  const index = zeroFill(newIndex,3);
  const code = donum.data('code') + index;

  donum.val(code);
});

function zeroFill( number, width )
{
  width -= number.toString().length;
  if ( width > 0 )
  {
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }
  return number + ""; // always return a string
}
</script>
