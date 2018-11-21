<!DOCTYPE html>
<html lang="es">
<head>
    <title>Remis Ola</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mio.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
            <div class="col-md-11">

               @include('barramenu')


                <h1>Planilla diaria <a href="#" onclick="window.print()"><span class="glyphicon glyphicon-print"></span></a></h1>
                   <div id="message">
                      @if (Session::get('message'))
                        {{Session::get('message')}}
                      @endif
                   </div>
                   <div>
                     @if (Session::get('imprime_ticket'))
                       {{ '<script>
                        window.open("'.Session::get('imprime_ticket').'","_blank")
                       </script>'}}
                    @endif
                   </div>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> Movil</th>
                            <th> Chofer </th>
                            <th> Viajes</th>
                            <th> Total</th>
                            <th> Gastos</th>
                            <th> Porcentaje Remisera </th>
                            <th> Porcentaje Coche </th>
                            @if(Auth::check())
                              <th class="hidden-print">Cierra Movil</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $data)
                        <tr>
                            <td> {{Mobiles::find($data->mobiles_id)->numerocoche}} </td>
                            <td> {{Choferes::find(Mobiles::find($data->mobiles_id)->choferes_id)->nombre}} </td>
                            <td> {{link_to('planilla/detalle/'.$data->mobiles_id, $data->viajes,array('class'=>'detalleplanilla'))}}</td>
                            <td> {{$data->monto}}</td>
                            <td>
                                 @if (Logmoviles::sumagastos($data->mobiles_id)[0]['gastos'] != null & Logmoviles::sumagastos($data->mobiles_id)[0]['gastos'] != 0)
                                    {{Logmoviles::sumagastos($data->mobiles_id)[0]['gastos']}}
                                 @else
                                    Sin gastos
                                 @endif
                            </td>
                            <td> {{$data->monto*($porcentaje->porcentaje_remisera/100)}}</td>
                            <td> {{$data->monto*((100-$porcentaje->porcentaje_remisera)/100)}}</td>
                            @if(Auth::check())
                            <td>
                                @if (!Mobiles::find($data->mobiles_id)->liquidado)
                                    {{link_to('/mobil/cierra/'.$data->mobiles_id,'Cerrar Movil',array('class'=>'hidden-print cierra_movil btn btn-success btn-xs'))}}
                                @else
                                    El movil cerrado {{date("d-m H:i", strtotime(Mobiles::find($data->mobiles_id)->deleted_at))}}
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$datos->links()}}
        </div>
    </div>
</div><!--container-->


               <div class="modal fade" id="cierra_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title" id="cierra_modal">Cierra Movil</h4>
                     </div>
                     <div class="modal-body">
                        <h4>¿Cerrar el movil?</h4>
                     </div>
                     <div class="modal-footer">
                       <a href="#" id="link_cierra_movil" class="btn btn-success">Si</a>
                       <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                     </div>
                   </div>
                 </div>
               </div>


                <div class="modal" id="viajes_coche">
                    <div class="modal-dialog modal-lg">
                        <div class='modal-content'>

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Detalle de Viajes</h4>
                            </div>

                            <div class='modal-body bodyviajes_coche'>

                            </div>
                        </div>
                    </div>
                </div>

</body>

</html>
