<table>
  <tr>
    <td colspan="6" style="font-size:15pt; font-weight:bold">Rekapan Surat Jalan {{$data->code}} ({{$data->pool}})</td>
  </tr>
  <tr rowspan="2">
    <td></td>
  </tr>
  {{-- header --}}
  <tr>
    <td>Tongkang</td>
    <td>: {{$data->code}}</td>
  </tr>
  <tr>
    <td>Customer</td>
    <td>: {{$data->customer_name}}</td>
  </tr>
  <tr>
    <td>Muatan</td>
    <td>: {{$data->freight_load}}</td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td>: {{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}</td>
  </tr>
  <tr>
    <td>Asal</td>
    <td>: {{$data->sender_name}}</td>
  </tr>
  <tr>
    <td>Tujuan</td>
    <td>: {{$data->recipient_name}}</td>
  </tr>
  <tr>
    <td>Petugas</td>
    <td>: {{$data->admin}}</td>
  </tr>
{{-- data --}}
<tr>
  <td colspan="5"></td>
</tr>
<tr style="border:1px solid black">
  <th style="border:1px solid black">No. Surat Jalan</th>
  <th style="border:1px solid black">Sopir</th>
  <th style="border:1px solid black">No. Plat</th>
  <th style="border:1px solid black">Tonase</th>
  <th style="border:1px solid black">Angkutan</th>
</tr>
@foreach ($details as $d)
  <tr>
    <td style="border:1px solid black"><b>{{$d->do_number}}</b> @if ($d->blend_ref_id) <small>(Blending {{\App\DeliveryOrder::find($d->blend_ref_id)->do_number}})</small> @endif </td>
    <td style="border:1px solid black">{{$d->driver}}</td>
    <td style="border:1px solid black; white-space:nowrap">{{$d->license_plate_no}}</td>
    <td style="border:1px solid black">{{$d->tonnage}} Kg.</td>
    <td style="border:1px solid black">{{App\VehicleOwner::find(App\Driver::find($d->driver_id)->owner_id)->name}}</td>
  </tr>
@endforeach
</table>
