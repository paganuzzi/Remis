@extends('admin.menuadmin')

@section('contenido')
     <div class="col-md-offset-3">
                    <ol class="breadcrumb">
                        <li><a href="/">Remis</a></li>
                        <li class="active">Usuarios</li>
                    </ol>
                    <div class="btn-group">
                      <a href="/user/create" class="btn btn-default glyphicon glyphicon-plus"> Nuevo</a>
                      <a href="/user/0" target="_blank" class="btn btn-default glyphicon glyphicon-print"> Imprimir</a>
                    </div>
                    <div id="message">
                            @if (Session::get('message'))
                                    {{Session::get('message')}}
                            @endif
                    </div>
                    <table class="table table-hover" id="coches">
                        <thead>
                            <tr>
                            	<th>Habilitado</th>
                                <th> Nombre y apellido </th>
                                <th> Correo electronico </th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($data as $data)
                            <tr>
                            	@if ($data->active)
                            		<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                            	@else
                            		<td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
								@endif
								<td><a href="/user/{{$data->id}}/edit">{{$data->nombreapellido}}</a></td>
								<td>{{$data->email}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

@stop

@section('us_active')
	class="active"
@stop
