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
  <th style="border:1px solid black" rowspan="2">No. Surat Jalan</th>
  <th style="border:1px solid black" rowspan="2">Tonase</th>
  <th style="border:1px solid black" rowspan="2">Pengambilan</th>
  <th style="border:1px solid black" colspan="3">Angkutan</th>
  <th style="border:1px solid black" colspan="2">Blending</th>
</tr>
<tr>
  <th style="border:1px solid black">Nama Angkutan</th>
  <th style="border:1px solid black">No. Plat</th>
  <th style="border:1px solid black">Sopir</th>
  {{-- <th style="border:1px solid black">Tarif</th> --}}
  <th style="border:1px solid black">Pengambilan</th>
  <th style="border:1px solid black">Tonase</th>
</tr>
@foreach ($details as $d)
  <tr>
    <td style="border:1px solid black"><b>{{$d->do_number}}</b> @if ($d->blending_origin) (Blending {{$d->blending_origin}}) @endif</td>
    <td style="border:1px solid black">{{$d->tonnage}}Kg.</td>
    <td style="border:1px solid black">{{rupiah($d->fare)}}</td>
    <td style="border:1px solid black">{{App\VehicleOwner::find(App\Driver::find($d->driver_id)->owner_id)->name}}</td>
    <td style="border:1px solid black; white-space:nowrap">{{$d->license_plate_no}}</td>
    <td style="border:1px solid black">{{$d->driver}}</td>
    @if ($d->blending_origin)
      {{-- <td style="border:1px solid black">{{$d->blending_destination}}</td>
      <td style="border:1px solid black">{{$d->blending_origin}}</td> --}}
      <td style="border:1px solid black">{{rupiah($d->blending_fare)}}</td>
      {{-- <td style="border:1px solid black">{{rupiah($d->blending_fare2)}}</td> --}}
      <td style="border:1px solid black">{{$d->blending_tonnage}}Kg.</td>
    @else
      <td style="border:1px solid black" colspan="2">-</td>
    @endif
  </tr>
@endforeach
</table>
