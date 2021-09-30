<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">{{$dateDesc}}</h3>
  </div>
  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead>
        <th>Status</th>
        <th>Tongkang</th>
        <th>Tanggal</th>
        <th>Customer</th>
        <th>Pengirim</th>
        <th>Penerima</th>
      </thead>
      <tbody>
        @foreach ($journal as $j)
          <tr>
            <td>
              @if ($j->show_available)
                <p class="text-success"><i class="fa fa-check"></i>Aktif</p>
              @endif
            </td>
            <td>{{$j->code}}</td>
            <td>{{\Carbon\Carbon::parse($j->created_at)->formatLocalized('%d %B %Y')}}</td>
            <td>{{$j->customer_name}}</td>
            <td>{{$j->sender_name}}</td>
            <td>{{$j->recipient_name}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
