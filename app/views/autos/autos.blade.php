@extends('admin.menuadmin')
@section('contenido')

                <div class="col-md-offset-3">
                    <ol class="breadcrumb">
                        <li><a href="/">Remis</a></li>
                        <li class="active">Coches</li>
                    </ol>
                    <div class="btn-group">
                      <a href="/autos/create" class="btn btn-default glyphicon glyphicon-plus"> Nuevo</a>
                      <a href="/autos/0" target="_blank" class="btn btn-default glyphicon glyphicon-print"> Imprimir</a>
                    </div>

                    <div id="message">
                            @if (Session::get('message'))
                                    {{Session::get('message')}}
                            @endif
                    </div>

                    <table class="table table-hover" id="coches">
                        <thead>
                            <tr>
                                <th> Habilitado </th>
                                <th> Marca </th>
                                <th> Modelo </th>
                                <th> Patente</th>
                                <th> Seguro</th>
                                <th>Venc. Seguro</th>
                                <th>N° Habilitacion</th>
                                <th>Venc. Habilitacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            @if($data->diasvencimiento < $config->avisovenceseguro or $data->vencehabilita < $config->avisovenceseguro)
                                <tr class="danger">
                            @else
                                <tr>
                            @endif
                            @if ($data->estado)
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                            @else
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                            @endif
                                <td> <a href="autos/{{$data->id}}/edit">{{$data->marca}}</a></td>
                                <td> {{$data->modelo}}</td>
                                <td> {{$data->patente}} </td>
                                <td> {{$data->aseguradora}} </td>
                                @if ($data->diasvencimiento >0)
                                    <td>{{date('d-m-Y',strtotime($data->vencimiento))}} <span class="badge"> {{$data->diasvencimiento}} dias</span></td>
                                @else
                                    <td> <span class="badge"> Vencido</span></td>
                                @endif
                                <td>{{$data->numhabilitacion}}</td>
                                @if ($data->vencehabilita > 0)
                                    <td>{{date('d-m-Y',strtotime($data->vencehabilitacion))}} <span class="badge"> {{$data->vencehabilita}} dias</span></td>
                                @else
                                    <td> <span class="badge"> Vencido</span></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
@stop

@section('aut_active')
    class="active"
@stop
