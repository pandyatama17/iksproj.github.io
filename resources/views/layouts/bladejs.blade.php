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
  $('.datatable-sm').dataTable({
    "dom": '<"pull-left"f><"pull-right"l>tip',
    "bPaginate": true,
    "pageLength" : 5,
    "responsive" : false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false
  });
  $(".datepicker").datepicker({
    calendarWeeks: true,
    todayHighlight: true,
    autoclose: true,
    format: "dd-mm-yyyy",
    language : "id"
  });
  $(".select2").select2();
  $(".icheck").iCheck({
     checkboxClass: 'icheckbox_flat-blue',
     radioClass: 'iradio_flat-blue',
  });
});
$(".url-redirect").on('click',function(e) {
  e.preventDefault();
  var url = $(this).attr('href');
  // $('.control-sidebar').trigger('click');
  $('.page-loader').addClass('show');
  setTimeout(function(){ window.location.href = url }, 100);
});
$(".url-unavailable").on('click',function(e) {
  e.preventDefault();
  Swal.fire("Dalam Pengembangan","fitur ini belum tersedia!",'warning')
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
$("#blendingCheck").on('ifChecked',function() {
  $("#blendingRefSelect").prop('disabled',false);
});
$("#blendingCheck").on('ifUnchecked',function() {
  $("#blendingRefSelect").prop('selectedIndex',0).trigger('change');
  $("#blendingRefSelect").prop('disabled',true);
})
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
      $("#freightLoadTxtFalse").val(response.freight_load);
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
$('body').on('click','a.finish-delivery',function(event) {
    event.preventDefault();
    Swal.fire({
      title : 'Konfirmasi Penyelesaian',
      html  : 'apakah anda yakin ingin menyelesaikan rekapan <b>' + $(this).data('code') + '</b>?',
      icon  : 'warning',
      showCancelButton  : true,
      cancelButtonColor : '#DC143C',
      cancelButtonText  : "Batalkan"
    }).then((confirm) => {
      if(confirm.isConfirmed){
        if ($(this).data('exported') == true)
        {
          // Swal.fire('Belom bisa wkjwkw', '', 'success')
          Swal.fire({
            title : 'Konfirmasi',
            html  : 'ketik "selesai" untuk mengkonfirmasi penyelesaian rekap <b>' + $(this).data('code') + '</b>',
            input : 'text',
            showCancelButton : true,
            cancelButtonText : 'Batalkan',
            preConfirm  : (hapus) =>{
            if (hapus.toUpperCase() == 'SELESAI') {
              // Swal.fire('Belom bisa wkjwkw', '', 'success')
              var url = "/tracking/delivery/finish&id=" + $(this).data('id');
              $(".page-loader").addClass('show');
              window.location.href = url;
            }
            else if (hapus.toUpperCase() != 'SELESAI') {
              Swal.fire('Inputan anda salah!', '', 'error');
            }}
          })
        }
        else {
          Swal.fire({
            title : 'Belum Diexport',
            text  : 'Rekapan ini belum di export, silahkan lakukan export terlebih dahulu, atau pilih "Export & Selesaikan"',
            icon  : 'warning',
            showCancelButton  : true,
            cancelButtonColor : '#DC143C',
            cancelButtonText  : "Batalkan",
            confirmButtonText : "Export & Selesaikan",
            // showDenyButton    : true
          }).then((confirm) => {
            if(confirm.isConfirmed){
              Swal.fire('Belom bisa wkjwkw', '', 'success');
            }
          });
        }
      }
    });
});
$(".ds-url").on('click',function(event){
  event.preventDefault();
  var transport_id = $(this).data('id');
  $.get({
    url : $(this).attr('href'),
    dataType : 'html',
    beforeSend : pageload(),
    success : function(response) {
      $("#driversCol").html(response);
      $("#transportID").val(transport_id);
      pageload();
    }
  })
});

$(".triggerEditUserInfo").on('click',function(event)
{
  var data = $(this).data();
  pageload();
  $("#userID").val(data.id);
  $("#txtUserName").val(data.name);
  $("#txtUserEmail").val(data.email);
  if (data.pool == 0) {
    $("#selectPool").attr('disabled','true');
  }
  else {
    $("#selectPool").removeAttr('disabled');

  }
  pageload();
  $("#userInfoModal").modal('show');
});

var table = $('#delivery-master-table').DataTable({
        "processing": true,
        "language" : '<div class="loader-overlay show page-loader"></div><div class="spanner show page-loader"><div class="loader"></div>  <p>Mohon menungggu, halaman sedang dimuat.</p></div>',
        "serverSide": true,
        "responsive": true,
        "ajax": {
            "url" : '{{route('get_deliveries_json')}}',
            "dataType" : 'json',
            "type" : 'post',
            "data" : {_token : '{{csrf_token()}}'}
        },
        "columns": [
            {"data" : "code"},
            {"data" : "date"},
            {"data" : "customer"},
            {"data" : "pool"},
            {"data" : "sender"},
            {"data" : "recipient"},
            {"data" : "freight_load"},
            {"data" : "tonnage"},
            {"data" : "rit"},
            {"data" : "options"},
        ],
        columnDefs: [
        {
            targets: [0,1,2,6,8],
            className: 'align-middle'
        }]
    });

function pageload()
{
    if($(".page-loader").hasClass('show'))
    {
        $(".page-loader").removeClass('show');
    }
    else {
        $(".page-loader").addClass('show');
    }
    // if (action == 'show'){
    //   $(".page-loader").addClass('show');
    // }
    // else {
    //   $(".page-loader").removeClass('show');
    // }
}
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
