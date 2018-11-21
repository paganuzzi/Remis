@extends('menu')

@section('contenido')

<div class="row">
	<div class="col-md-12">
		<table class="table table-hover" id="programados">
	    	<thead>
	        	<tr>
	            	<th>Fecha de despacho</th>
	            	  <th>Origen</th>
	                <th>Notas</th>
	                <th>Estado</th>
	                <th>Repite</th>
	            </tr>
	        </thead>
			<tbody>
	        	@foreach($programados as $prog)
	            	@if ($prog->despachado & date('y',strtotime($prog->deleted_at)) > 0)
	            		<tr class="success">
	            	@else
	            		<tr class="danger">
	            	@endif
	            	<td>{{date("d-m H:i", strtotime($prog->fecha_despacho))}}</td>
	            	<td>{{$prog->origen}}</td>
	                <td>{{$prog->notas}}</td>
	                <td>
	                	@if ($prog->despachado)
                      @if (date('y',strtotime($prog->deleted_at)) > 0)
                         Despachado a las {{date('d-m-y H:i',strtotime($prog->deleted_at))}}
                      @else
                          Ignorado por
                          {{
                            User::find(Logusuarios::select('id_users')->where('accion','=','ignoraprogramado')->where('id_accion','=',$prog->id)->get()[0]->id_users)->nombreapellido;
                          }}
                      @endif
                    @else
	                		{{link_to('prog/'.$prog->id.'/edit','Editar')}}
	                	@endif
	                </td>
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
	            </tr>
	            @endforeach
			</tbody>
		</table>
		{{$programados->links()}}
	</div>
</div>


@stop
