<div class="card card-outline card-secondary" id="do-row-{{$index}}">
  <div class="card-header">
    <h3 class="card-title">Surat Jalan {{$code.$rowIndex}}</h3>
    <div class="card-tools">
      @if ($index > 1)
        <button type="button" class="btn btn-tool bg-danger" id="deleteDO-{{$index}}">
          <i class="fa fa-trash"></i> Hapus
        </button>
      @endif
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-4 col-6">
        <div class="form-group">
          <label for="">No. Surat jalan</label>
          <input type="text" class="form-control" name="do_number[]"  id="DONumberTxt{{$index}}" value="{{$code.$rowIndex }}" readonly>
        </div>
      </div>
      <div class="col-lg-5 col-6">
        <div class="form-group">
          <label for="">Blendingan Surat</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"  style="padding:0 !important">
                <input type="checkbox" class="icheck" class="" id="blendingCheck-{{$index}}" name="blending-{{$index}}">
              </span>
            </div>
            <select class="select2 form-control" name="blending_ref_id-{{$index}}" id="blendingRefSelect-{{$index}}" disabled>
              <option selected disabled>SJ Referensi..</option>
              @foreach ($delivery_orders as $do)
                <option value="{{$do->id}}">{{$do->do_number}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-5">
        <div class="form-group">
          <label for="">Tonase</label>
          <div class="input-group">
            <input type="number" class="form-control" name="tonnage[]" autocomplete="off">
            <div class="input-group-append">
              <span class="input-group-text">Kg.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-8 col-lg-4 ">
        <label for="">Angkutan</label>
        <br>
        <select class="select2 form-control" style="width:100%" id="transportSelect{{$index}}">
          <option selected disabled> Pilih angkutan... </option>
          @foreach ($transports as $tr)
            <option value="{{$tr->id}}">{{$tr->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-6 col-lg-5 " id="driverCol{{$index}}">
        <label for="">Sopir</label>
        <br>
        <select class="select2 form-control" style="width:100%" id="driverSelect{{$index}}" disabled name="driver_id[]">
          <option selected disabled> Pilih sopir... </option>
        </select>
      </div>
      <div class="col-6 col-lg-3">
        <div class="form-group">
          <label>No. Plat</label>
          <input type="text" readonly value="-" id="plateNumberTxt{{$index}}" name="license_plate_no[]" class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      {{-- <div class="col-8">
      </div> --}}
      <div class="col-8 col-lg-5">
        <div class="form-group">
          <label>Tarip</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Rp</span>
            </div>
            <input type="number" class="form-control" name="fare[]" autocomplete="off">
            <div class="input-group-append">
              <span class="input-group-text">,-</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  @if ($index > 1)
    $("#deleteDO-{{$index - 1}}").hide();
  @endif
  $('body, html').animate({
    scrollTop: $("#do-row-{{$index}}").offset().top
  }, 600);
  $(".icheck").iCheck({
     checkboxClass: 'icheckbox_flat-blue',
     radioClass: 'iradio_flat-blue',
  });
});
$("#deleteDO-{{$index}}").on('click',function()
{
  $("#DOIndex").val({{$index}});
  $("#deleteDO-{{$index - 1}}").show();
  $("#do-row-{{$index}}").slideUp("normal", function() { $(this).remove(); } );
});
$(".select2").select2({
  // placeholder : $(this).data('placeholder')
});
$("#transportSelect{{$index}}").on('change',function(event)
{
    const url = "/tracking/ajaxCall/driversJSON&transport=" + $(this).val();
    $.ajax({
      url : url,
      type: 'GET',
      dataType: 'json',
      success: function(response)
      {
        console.log(response);
        $('#driverSelect{{$index}}').prop('disabled', false);
        $('#driverSelect{{$index}}').find('option').not(':disabled').remove();
        $.each(response, function (i, dr) {
            $('#driverSelect{{$index}}').append($('<option>', {
                value: dr.id,
                text : dr.name
            }));
        });
      }
    })
});
$("#driverSelect{{$index}}").on('change',function(event)
{
    const url = "/tracking/ajaxCall/driverDetails&driverID=" + $(this).val();
    $.ajax({
      url : url,
      type: 'GET',
      dataType: 'json',
      success: function(response)
      {
        $("#plateNumberTxt{{$index}}").val(response.license_plate_no);
        $("#plateNumberTxt{{$index}}").attr('readonly',false);
      }
    })
});
$("#blendingCheck-{{$index}}").on('ifChecked',function() {
  $("#blendingRefSelect-{{$index}}").prop('disabled',false);
});
$("#blendingCheck-{{$index}}").on('ifUnchecked',function() {
  $("#blendingRefSelect-{{$index}}").prop('selectedIndex',0).trigger('change');
  $("#blendingRefSelect-{{$index}}").prop('disabled',true);
})
</script>
