<label for="">Mobil</label>
<br>
<select class="select2 form-control" name="license_plate_no" id="driverSelect" style="width:100%">
  <option selected disabled> Pilih Mobil... </option>
  @foreach ($drivers as $dr)
    <option value="{{$dr->id}}">{{$dr->license_plate_no}}</option>
  @endforeach
</select>
<script type="text/javascript">
$(".select2").select2();
$("#driverSelect").on('change',function(event)
{
    const url = "{{url('/')}}/ajaxCall/driverDetails&driverID=" + $(this).val();
    $.ajax({
      url : url,
      type: 'GET',
      dataType: 'json',
      success: function(response)
      {
        console.log(response);
        $("#driverIDHidTXT").val(response.id);
        $("#driverLicenseHidTXT").val(response.license_plate_no);
        $("#driverNameTxt").val(response.name);
        $("#driverNameTxt").attr('readonly',false);
      }
    })
});
</script>
