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
                <caption>MARCA: <b>{{$t->marca}}</b> - MODELO: <b>{{$t->modelo}}</b> - PATENTE: <b>{{$t->patente}}</b>  @if($t->estado) - ESTADO: <b>ACTIVO</b>@else - ESTADO: <b>INACTIVO</b>@endif</b></caption>
                <thead>
                  <th>Aseguradora</th>
                  <th>Vto. Seguro</th>
                  <th>N° Habilitacion</th>
                  <th>Vto. Habilitacion</th>
                  <th>Alta</th>
                </thead>
                <tbody>
                  <td>{{$t->aseguradora}}</td>
                  <td>{{date('d-m-Y',strtotime($t->vencimiento))}}</td>
                  <td>{{$t->numhabilitacion}}</td>
                  <td>{{date('d-m-Y',strtotime($t->vencehabilitacion))}}</td>
                  <td>{{date('d-m-Y',strtotime($t->created_at))}}</td>
                </tbody>
              </table>
              <hr>
        </div>
      @endforeach
    </div>
  </body>
</html>
