@extends('admin.menuadmin')
@section('contenido')
                <div class="col-md-offset-3">
                    <ol class="breadcrumb">
                        <li><a href="/">Remis</a></li>
                        <li class="active">Choferes</li>
                    </ol>
                    <div class="btn-group">
                      <a href="/choferes/create" class="btn btn-default glyphicon glyphicon-plus"> Nuevo</a>
                      <a href="/choferes/0" target="_blank" class="btn btn-default glyphicon glyphicon-print"> Imprimir</a>
                    </div>

                    <div id="message">
                            @if (Session::get('message'))
                                    {{Session::get('message')}}
                            @endif
                    </div>

                    <table class="table table-hover" id="choferes">
                        <thead>
                            <tr>
                                <th> Habilitado </th>
                                <th> Nombre</th>
                                <th> Dni </th>
                                <th> Telefono </th>
                                <th> Direccion</th>
                                <th> N° Licencia </th>
                                <th> Vencimiento </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            @if($data->diasvencimiento < $config->avisovencechofer)
                                <tr class="danger">
                            @else
                                <tr>
                            @endif
                                @if ($data->estado)
                                    <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                @else
                                    <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                @endif
                                <td>
                                  @if (date('d-m',strtotime($data->fechanac)) == date('d-m',strtotime(Carbon::now())))
                                    <span class="label label-success pull-right">¡¡cumple!!</span><a href="choferes/{{$data->id}}/edit/">{{$data->nombre}}</a>
                                  @else
                                    <a href="choferes/{{$data->id}}/edit/">{{$data->nombre}}</a>
                                  @endif
                                </td>
                                <td> {{$data->dni}} </td>
                                <td> {{$data->telefono}}</td>
                                <td> {{$data->direccion}}</td>
                                <td> {{$data->numlicencia}} </td>
                                @if ($data->diasvencimiento > 0)
                                    <td> {{date('d-m H:i',strtotime($data->vencimiento))}} <span class="badge"> {{$data->diasvencimiento}} dias</span> </td>
                                @else
                                    <td> <span class="badge"> Vencido</span></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
@stop()

@section('chof_active')
    class="active"
@stop
