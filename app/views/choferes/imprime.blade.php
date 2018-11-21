<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <title>{{Configuraciones::find(1)->nombreremis}}</title>
  </head>
  <script language="javascript">
				 function imprime(){
						window.print();
						setTimeout(function(){window.close();}, 15);
				}
   </script>
  <body onload="imprime()">
    <div class="container-fluid">
      @foreach($todo as $t)
      <div class="row">
              <table class="table">
                <caption>CHOFER: <b>{{$t->nombre}}</b> - DNI: <b>{{$t->dni}}</b>@if($t->estado) - ESTADO: <b>ACTIVO</b>@else - ESTADO: <b>INACTIVO</b>@endif</b></caption>
                <thead>
                  <th>Nacimiento</th>
                  <th>Telefono</th>
                  <th>Direccion</th>
                  <th>N° Licencia</th>
                  <th>Otorgamiento</th>
                  <th>Vencimiento</th>
                  <th>Clases</th>
                  <th>Grupo/Factor</th>
                  <th>Restric.</th>
                  <th>Alta</th>
                </thead>
                <tbody>
                  <td>{{date('d-m-Y',strtotime($t->fechanac))}}</td>
                  <td>{{$t->telefono}}</td>
                  <td>{{$t->direccion}}</td>
                  <td>{{$t->numlicencia}}</td>
                  <td>{{$t->otorgamiento}}</td>
                  <td>{{$t->vencimiento}}</td>
                  <td>{{$t->clases}}</td>
                  <td>{{$t->grupofactor}}</td>
                  <td>{{$t->restricciones}}</td>
                  <td>{{date('d-m-Y',strtotime($t->created_at))}}</td>
                </tbody>
              </table>
              <hr>
        </div>
      @endforeach
    </div>
  </body>
</html>
