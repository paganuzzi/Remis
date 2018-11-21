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
                <caption>USUARIO: <b>{{$t->nombreapellido}}</b></caption>
                <thead>
                  <th>Email</th>
                  <th>Tipo de Usuario</th>
                  <th>Alta</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                  <td>{{$t->email}}</td>
                  @if ($t->usertype == 0)
                     <td>Administrador</td>
                  @else
                     <td>Usuario</td>
                  @endif
                  <td>{{date('d-m-Y',strtotime($t->created_at))}}</td>
                  @if($t->active)
                     <td>Activo</td>
                  @else
                     <td>Inactivo</td>
                  @endif
                </tbody>
              </table>
              <hr>
        </div>
      @endforeach
    </div>
  </body>
</html>
