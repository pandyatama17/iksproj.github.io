<label for="">Sopir</label>
<br>
<select class="select2 form-control" name="driver" id="driverSelect" style="width:100%">
  <option selected disabled> Pilih sopir... </option>
  @foreach ($drivers as $dr)
    <option value="{{$dr->id}}">{{$dr->name}}</option>
  @endforeach
</select>
<script type="text/javascript">
$(".select2").select2();
$("#driverSelect").on('change',function(event)
{
    const url = "/ajaxCall/driverDetails&driverID=" + $(this).val();
    $.ajax({
      url : url,
      type: 'GET',
      dataType: 'json',
      success: function(response)
      {
        $("#plateNumberTxt").val(response.license_plate_no);
        $("#plateNumberTxt").attr('readonly',false);
      }
    })
});
</script>
