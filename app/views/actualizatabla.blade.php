<table class="table table-hover">
                    <caption><h4>Viajes</h4></caption>
                    <thead>
                        <tr>
                            <th>Movil
                              <span class="glyphicon glyphicon-search" id="buscamovilicono"></span>
                              <form id="buscamovil" class="hidden">
                                <input type="text" id="numeromovilbuscado"  onblur="ocultabuscamovil()" class="form-control" style="position:absolute;width:8em;" autocomplete="off" placeholder="N° Movil">
                              </form>
                            </th>
                            <th> Origen </th>
                            <th> Destino </th>
                            <th> Notas </th>
                            <th> Hora Viaje </th>
                            <th> Tiempo en viaje </th>
                            <th> Termina </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        @if ($data->programado)
                            <tr class="danger">
                        @else
                            <tr>
                        @endif
                            @if($data->idmobil<>0)
                                <td> <b>{{link_to('reasigna/' . $data->idviaje ,$data->numerocoche , array('class'=>'reasigna_mobil'))}}</b></td>
                            @else
                                <td> {{link_to('asigna/' . $data->idviaje , 'Asignar Movil', array('class'=>'asigna_mobil btn btn-default btn-xs'))}}</td>
                            @endif
                            <td> {{$data->origen}} </td>
                            @if (empty($data->destino))
                                <td>{{link_to('asignadestino/'.$data->idviaje,'Asignar Destino',array('class'=>'asigna_destino btn btn-primary btn-xs'))}}</td>
                            @else
                                <td>{{link_to('asignadestino/'.$data->idviaje,$data->destino,array('class'=>'asigna_destino'))}}</td>
                            @endif
                            <td> {{$data->notas}} </td>
                            <td> {{date("d-m H:i", strtotime($data->created_at))}} </td>

                            @if ($data->idmobil<>0)
                                @if ($data->tiempoviaje > $config->tiempomaxviaje)
                                    <td><span class="label label-danger">Excedido</span> {{$data->tiempoviaje}}</td>
                                @else
                                    <td><span class="label label-success">En viaje</span> {{$data->tiempoviaje}} </td>
                                @endif
                            @else
                                <td><span class="glyphicon glyphicon-minus"></span></td>
                            @endif
                            @if ($data->idmobil<>0)
                                <td> {{link_to('termina/' . $data->idviaje, 'Termina Viaje', array('class'=>'termina_viaje btn btn-danger btn-xs'))}}</td>
                            @else
                                <td><a href="{{$data->idviaje}}" class="borraviaje glyphicon glyphicon-trash"></a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                  </table>

                  <hr />

                  @if($prog)
                    <table class="table table-hover">
                    <caption><h4>Programados del dia</h4></caption>
                    <thead>
                        <tr>
                            <th>Fecha de despacho</th>
                            <th>Origen</th>
                            <th>Notas</th>
                            <th>Repite</th>
                            <th>Editar | Borrar</th>
                            <th>Crear Viaje</th>
                            <th>Ignorar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prog as $prog)
                        <tr class="danger">
                            <td>{{date("d-m H:i", strtotime($prog->fecha))}}</td>
                            <td>{{$prog->origen}}</td>
                            <td>{{$prog->notas}}</td>
                            <td>
                              @if ($prog->repite == null)
                              <span class="glyphicon glyphicon-minus"></span>
                              @endif
                              @if ($prog->repite == 1)
                              <span class="glyphicon glyphicon-refresh"></span> D
                              @endif
                              @if ($prog->repite == 2)
                              <span class="glyphicon glyphicon-refresh"></span> S
                              @endif
                              @if ($prog->repite == 3)
                              <span class="glyphicon glyphicon-refresh"></span> DL
                              @endif
                            </td>
                            <td>{{link_to('prog/'.$prog->id.'/edit','Editar',array('class'=>'edit_prog'))}} | <a href='prog/{{$prog->id}}/edit' class='borraprog glyphicon glyphicon-trash'></a></td>
                            <td>{{link_to('prog/progtoviaje/'.$prog->id,'Crear Viaje')}}</td>
                            <td>{{link_to('prog/ignora/'.$prog->id,'Ignorar')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                  @endif
