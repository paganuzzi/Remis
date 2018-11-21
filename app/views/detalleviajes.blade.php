<!--imprime = true mando el header y los tags html-->

@if ($imprime)
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    </head>
    <script language="javascript">
              function imprime(){
                  window.print();
                  setTimeout(function(){window.close();}, 1);
          }
    </script>
    <body onload="imprime()">
        <div class="container">
            <h1>Detalles Movil {{Mobiles::find($data[0]->mobiles_id)->numerocoche}}<h1>
@endif
@if ($imprime===false)
    <h2><a href="planilla/imprime/detalle/{{$id}}" target="_blank"><span class="glyphicon glyphicon-print"></span></a></h2>
@endif
<table class="table table-hover">
    <thead>
        <tr>
            <th> Coche </th>
            <th> Origen</th>
            <th> Destino</th>
            <th> Monto </th>
            <th> Fecha/Hora Inicio </th>
            <th> Fecha/Hora Final </th>
            <th> Notas </th>
        </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            @if($data->adeuda)
                <tr class="danger">
            @else
                <tr>
            @endif
                    <td> {{Mobiles::find($data->mobiles_id)->numerocoche}} </td>
                    <td> {{$data->origen}}</td>
                    <td> {{$data->destino}}</td>
                    <td> {{$data->monto}}</td>
                    <td> {{date("H:i  d-m-Y",strtotime($data->created_at))}}</td>
                    <td> {{date("H:i  d-m-Y",strtotime($data->updated_at))}}</td>
                    <td> {{$data->notas}} </td>
                </tr>
            @endforeach
        </tbody>
</table>

@if ($imprime)
    </div>
</body>
</html>
@endif
