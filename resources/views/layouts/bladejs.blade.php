<script type="text/javascript">
$(window).on('load',function() {
    setTimeout(function(){ $('.page-loader').removeClass('show'); }, 100);
  });
$.fn.datepicker.dates['id'] = {
    days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
    daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    daysMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
    today: "Hari Ini",
    clear: "Clear",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};
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
    calendarWeeks: true,
    todayHighlight: true,
    autoclose: true,
    format: "dd-mm-yyyy",
    language : "id"
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

// $('#customerTxt').autocomplete({
//   serviceUrl: '/ajaxCall/getReference&header=3',
//   appendTo : '#suggestions-container',
//   onSelect: function (ref) {
//     alert('You selected: ' + ref.body);
//   }
// });
$('#customerTxt').autocomplete({
    serviceUrl: '/ajaxCall/getReference&header=3',
    dataType: 'json',
    responseTime: 10,
    type: 'GET',
    ajaxSettings:{
      beforeSend: function(jqXHR, settings) {
          $("#customerTxt").addClass('pulse');
        },
        success: function() {
          $("#customerTxt").removeClass('pulse');
        }
    },
    autoSelectFirst: true
});
$('#codeTxt').autocomplete({
    serviceUrl: '/ajaxCall/getReference&header=1',
    dataType: 'json',
    responseTime: 10,
    type: 'GET',
    ajaxSettings:{
      beforeSend: function(jqXHR, settings) {
          $("#codeTxt").addClass('pulse');
        },
        success: function() {
          $("#codeTxt").removeClass('pulse');
        }
    },
    autoSelectFirst: true
});
$('#senderTxt').autocomplete({
    serviceUrl: '/ajaxCall/getReference&header=3',
    dataType: 'json',
    responseTime: 10,
    type: 'GET',
    ajaxSettings:{
      beforeSend: function(jqXHR, settings) {
          $("#senderTxt").addClass('pulse');
        },
        success: function() {
          $("#senderTxt").removeClass('pulse');
        }
    },
    autoSelectFirst: true
});
$('#recipientTxt').autocomplete({
    serviceUrl: '/ajaxCall/getReference&header=3',
    dataType: 'json',
    responseTime: 10,
    type: 'GET',
    ajaxSettings:{
      beforeSend: function(jqXHR, settings) {
          $("#recipientTxt").addClass('pulse');
        },
        success: function() {
          $("#recipientTxt").removeClass('pulse');
        }
    },
    autoSelectFirst: true
});
$('#FreightLoadTxt').autocomplete({
    serviceUrl: '/ajaxCall/getReference&header=2',
    dataType: 'json',
    responseTime: 10,
    type: 'GET',
    ajaxSettings:{
      beforeSend: function(jqXHR, settings) {
          $("#FreightLoadTxt").addClass('pulse');
        },
        success: function() {
          $("#FreightLoadTxt").removeClass('pulse');
        }
    },
    autoSelectFirst: true
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
