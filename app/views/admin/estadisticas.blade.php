@extends('admin.menuadmin')
@section('contenido')
                <div class="col-md-offset-2">
                    <ol class="breadcrumb">
                        <li><a href="/">Remis</a></li>
                        <li class="active">Estadisticas</li>
                    </ol>
                    @if (Session::get('message')){{Session::get('message')}}@endif

                    @include('admin.grafico')

                    <hr>

                    <table class="table table-hover">
                      <caption>
                        <h4>Viajes por Movil</h4>
                      </caption>
                    <thead>
                        <tr>
                            <th>Movil</th>
                            <th>Choferes</th>
                            <th>Coche</th>
                            <th>Cantidad Viajes</th>
                            <th>Suma Viajes</th>
                            <th>Ganancia Agencia</th>
                            <th>Promedio</th>
                        </tr>
                    </thead>
                    @if($datos->count() > 0)
                    <tbody>
                        @foreach($datos as $data)
                            <tr>
                                <td>{{$data->numerocoche}}</td>
                                <td>{{Choferes::find($data->choferes_id)->nombre}}</td>
                                <td>{{Coches::find($data->coches_id)->marca}} / {{Coches::find($data->coches_id)->modelo}} / {{Coches::find($data->coches_id)->patente}}</td>
                                <td>{{round($data->cantidad,0)}}</td>
                                <td>$ {{round($data->suma_viajes,2)}}</td>
                                <td>$ {{round($data->suma_viajes*($config->porcentaje_remisera/100),2)}}</td>
                                <td>$ {{round($data->suma_viajes/$data->cantidad,2)}}</td>
                            </tr>
                        @endforeach
                        <tr class="info">
                          <th>Totales:</th>
                          <td></td>
                          <td></td>
                          <th>{{$datos->sum('cantidad')}}</th>
                          <th>$ {{$datos->sum('suma_viajes')}}</th>
                          <th>$ {{round($datos->sum('suma_viajes')*($config->porcentaje_remisera/100),2)}}</th>
                          <th>$ {{round($datos->sum('suma_viajes')/$datos->sum('cantidad'),2)}}</th>
                        </tr>
                    </tbody>
                    @endif
                    </table>
                    {{$datos->links()}}

                    <hr>

                    <table class="table table-hover">
                      <caption><h4>Viajes Adeudados</h4></caption>
                      <thead>
                        <tr>
                          <th>Chofer</th>
                          <th>Auto</th>
                          <th>Origen</th>
                          <th>Destino</th>
                          <th>Notas</th>
                          <th>Monto</th>
                          <th>Borrar</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if ($adeudados)
                        @foreach($adeudados as $ad)
                        <tr>
                          <td><a href="choferes/{{Mobiles::find($ad->mobiles_id)->choferes_id}}/edit">{{Choferes::find(Mobiles::find($ad->mobiles_id)->choferes_id)->nombre}}</a></td>
                          <td><a href="autos/{{Mobiles::find($ad->mobiles_id)->coches_id}}/edit">{{Coches::find(Mobiles::find($ad->mobiles_id)->coches_id)->patente}}</a></td>
                          <td>{{$ad->origen}}</td>
                          <td>{{$ad->destino}}</td>
                          <td>{{$ad->notas}}</td>
                          <td>$ {{round($ad->monto,2)}}</td>
                          <td><a href="/borraadeudado/{{$ad->id}}" class="glyphicon glyphicon-trash borraviajeadeudadoclick"></a></td>
                        </tr>
                        @endforeach
                        <tr class="info">
                          <th>Totales:</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>$ {{round($adeudados->sum('monto'))}}</th>
                          <th></th>
                        </tr>
                        @endif
                      </tbody>
                    </table>

                    <hr>

                    <table class="table table-hover">
                      <caption><h4>Gastos de Moviles</h4></caption>
                      <thead>
                        <tr>
                          <th>Numero Movil</th>
                          <th>Chofer</th>
                          <th>Auto</th>
                          <th>Monto</th>
                          <th>Detalle</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($logmoviles as $log)
                        <tr>
                          <td>{{Mobiles::find($log->mobil_id)->numerocoche}}</td>
                          <td><a href="choferes/{{Mobiles::find($log->mobil_id)->choferes_id}}/edit">{{Choferes::find(Mobiles::find($log->mobil_id)->choferes_id)->nombre}}</a></td>
                          <td><a href="autos/{{Mobiles::find($log->mobil_id)->coches_id}}/edit">{{Coches::find(Mobiles::find($log->mobil_id)->coches_id)->patente}}</a></td>
                          <td>$ {{round($log->monto,2)}}</td>
                          <td><a href="{{$log->mobil_id}}" class="btn btn-default detallelog btn-sm">Detalle</a></td>
                        </tr>
                        @endforeach
                        <tr class="info">
                          <th>Totales:</th>
                          <th></th>
                          <th></th>
                          <th>$ {{$logmoviles->sum('monto')}}</th>
                          <th></th>
                        </tr>
                      </tbody>
                    </table>
                    {{$logmoviles->links()}}

                    <hr>

                    <table class="table table-hover">
                      <caption><h4>Moviemientos de Usuarios</h4></caption>
                      <thead>
                        <th>Usuario</th>
                        <th>Activo</th>
                        <th>Tipo Usuario</th>
                        <th>Detalles</th>
                      </thead>
                      <tbody>
                        @foreach($usuarios as $usu)
                        <tr>
                          <td>{{$usu->nombreapellido}}</td>
                          <td>
                          @if ($usu->active)
                            <span class="glyphicon glyphicon-ok"></span>
                          @else
                            <span class="glyphicon glyphicon-remove"></span>
                          @endif
                          </td>
                          <td>
                          @if ($usu->usertype == 0)
                            Administrador
                          @else
                            Usuario
                          @endif
                          </td>
                          <td>{{link_to('estadisticas/'.$usu->id,'Detalles',['class'=>'btn btn-info'])}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>




                <!--modales-->

                <div class="modal fade" id="borraviajeadeudado" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Cobro de un viaje adeudado</h4>
                      </div>
                      <div class="modal-body">
                        <div data>

                        </div>
                        ¿Usted Cobro el viaje seleccionado?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        <a href="" class="btn btn-success siborraviajeadeudado">Si</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="detallelogmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Detalle de gastos</h4>
                      </div>
                      <div class="modal-body detallegastos">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>

@stop()

@section('est_active')
    class="active"
@stop
