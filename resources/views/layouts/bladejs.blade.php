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
$(".url-redirect").on('click',function(e) {
  e.preventDefault();
  var url = $(this).attr('href');
  // $('.control-sidebar').trigger('click');
  $('.page-loader').addClass('show');
  setTimeout(function(){ window.location.href = url }, 100);
});
$("#transportSelect").on('change',function(event)
{
    const url = "/tracking/ajaxCall/drivers&transport=" + $(this).val();
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
//   serviceUrl: '/tracking/ajaxCall/getReference&header=3',
//   appendTo : '#suggestions-container',
//   onSelect: function (ref) {
//     alert('You selected: ' + ref.body);
//   }
// });
$('#customerTxt').autocomplete({
    serviceUrl: '/tracking/ajaxCall/getReference&header=3',
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
    serviceUrl: '/tracking/ajaxCall/getReference&header=1',
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
    serviceUrl: '/tracking/ajaxCall/getReference&header=3',
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
    serviceUrl: '/tracking/ajaxCall/getReference&header=3',
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
    serviceUrl: '/tracking/ajaxCall/getReference&header=2',
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

$("#deliverySelect").on('change',function() {
  var url = "/tracking/ajaxCall/getDeliveryDetails&id="+$(this).val();
  var code = $(this).find('option:selected').text();
  $.get({
    url: url,
    dataType: 'json',
    beforeSend: function(jqXHR, settings) {
        $(".page-loader").addClass('show');
    },
    success: function(response) {
      $("#adminTxtFalse").val(response.admin);
      $("#customerNameTxtFalse").val(response.customer_name);
      $("#poolTxtFalse").val(response.pool);
      $("#dateTxtFalse").val(response.date);
      $(".false-input").prop('disabled',true);
      // $(".page-loader").removeClass('show');
      $("#DOIndex").val('1');
      $("#do-form").html('');
      newDOChild($("#deliverySelect").val(),code,$("#DOIndex").val());
      if ($(window).width() <= 768)
      {
        $("#header-card").CardWidget('collapse');
      }
      $("#form-footer").slideDown();
    }
  });
  $("#addDOChild").on('click',function()
  {
      var id = $("#deliverySelect").val();
      var code = $("#deliverySelect").find('option:selected').text();
      var currRow = $("#DOIndex").val();
      newDOChild(id,code,currRow);
  });
});
function newDOChild(id,code,index)
{
  var url = "/tracking/ajaxCall/newDOLine&id="+id+"&code="+code+"&index="+index;

  $.get({
    url: url,
    dataType: 'html',
    beforeSend: function(jqXHR, settings) {
        $(".page-loader").addClass('show');
    },
    success: function(response) {
      $("#do-form").append(response);
      $(".page-loader").removeClass('show');
      index++;
      $("#DOIndex").val(index);
      // $('body, html').animate({
      //   scrollTop: $("#do-row-"+index).offset().top
      // }, 600);
    }
  });
}

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
