<table class="table">
  <caption><h3>Gastos de Movil {{Mobiles::find($logmoviles[0]->mobil_id)->numerocoche}}</h3></caption>
  <thead>
    <tr>
      <th>Chofer</th>
      <th>Auto</th>
      <th>Monto</th>
      <th>Detalle</th>
    </tr>
  </thead>
  <tbody>
    @foreach($logmoviles as $log)
    <tr>
      <td>{{Choferes::find(Mobiles::find($log->mobil_id)->choferes_id)->nombre}}</td>
      <td>{{Coches::find(Mobiles::find($log->mobil_id)->coches_id)->patente}}</td>
      <td>{{$log->gastos}}</td>
      <td>{{$log->estado}}</td>
      <td>{{$log->detalle}}</td>
      <td>{{date("d-m H:i",strtotime($log->created_at))}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
