<table class="table table-condensed">
    <thead>
    <tr>
        <th>Pausa</th>
        <th>Monto</th>
        <th>Fecha</th>
    </tr>
    </thead>
  <tbody>
    @foreach($logremis as $log)
    <tr>
      @if ($log->detalle)
        <td>{{$log->detalle}}</td>
      @else
        <td>Sin Especificar</td>
      @endif
      <td>{{$log->gastos}}</td>
      <td>{{date('d-m-Y H:i:s',strtotime($log->created_at))}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
