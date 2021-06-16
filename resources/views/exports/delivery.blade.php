<table>
  <tr>
    <td colspan="6" style="font-size:15pt; font-weight:bold">Rekapitulasi Perputaran Truk {{$data->code}} ({{$data->pool}})</td>
  </tr>
  <tr rowspan="2">
    <td></td>
  </tr>
  {{-- header --}}
  <tr>
    <td>Tug Boat/Bargain</td>
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
{{-- <tr style="border:1px solid black">
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
  <th style="border:1px solid black">Pengambilan</th>
  <th style="border:1px solid black">Tonase</th>
</tr> --}}
<tr style="border:1px solid black">
  <th style="border:1px solid black">Tgl.</th>
  <th style="border:1px solid black">No. Ritase</th>
  <th style="border:1px solid black">No. Surat Jalan</th>
  {{-- <th style="border:1px solid black">No. Surat Jalan</th> --}}
  <th style="border:1px solid black">No. Plat</th>
  <th style="border:1px solid black">Nama Sopir</th>
  <th style="border:1px solid black">Nama Angkutan</th>
  <th style="border:1px solid black">Tonase</th>
  <th style="border:1px solid black">Kasbon UJ</th>
  <th style="border:1px solid black">Asal Blending</th>
  <th style="border:1px solid black">UJ Blending</th>
  {{-- <th style="border:1px solid black">Tonase Blending</th> --}}
  <th style="border:1px solid black">Keterangan</th>
</tr>
@foreach ($details as $index => $d)
  <tr>
    <td style="border:1px solid black">{{\Carbon\Carbon::parse($data->created_at)->format('d-m-Y')}}</td>
    {{-- <td style="border:1px solid black"><b>{{$d->do_number}}</b> @if ($d->blending_origin) (Blending {{$d->blending_origin}}) @endif</td> --}}
    <td style="border:1px solid black">{{sprintf('%03d', $index+1)}}</td>
    <td style="border:1px solid black">{{str_replace($data->code,'',$d->do_number)}}</td>
    {{-- <td style="border:1px solid black"><b>{{$d->do_number}}</b> </td> --}}
    <td style="border:1px solid black; white-space:nowrap">{{$d->license_plate_no}}</td>
    <td style="border:1px solid black">{{$d->driver}}</td>
    <td style="border:1px solid black">{{App\VehicleOwner::find(App\Driver::find($d->driver_id)->owner_id)->name}}</td>
    <td style="border:1px solid black"> Kg.</td>
    <td style="border:1px solid black">{{rupiah($d->fare)}}</td>
    @if ($d->blending_origin)
      {{-- <td style="border:1px solid black">{{$d->blending_destination}}</td>
      <td style="border:1px solid black">{{$d->blending_origin}}</td> --}}
      <td style="border:1px solid black">{{$d->blending_origin}}</td>
      <td style="border:1px solid black">{{rupiah($d->blending_fare)}}</td>
      {{-- <td style="border:1px solid black">{{rupiah($d->blending_fare2)}}</td> --}}
      {{-- <td style="border:1px solid black">{{$d->blending_tonnage}}Kg.</td> --}}
    @else
      <td style="border:1px solid black" colspan="2" class="text-center">-</td>
    @endif
    <td style="border:1px solid black"></td>
  </tr>
@endforeach
</table>
