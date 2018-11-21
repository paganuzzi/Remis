<table class="table table-hover" id="programados">
	    	<thead>
	        	<tr>
	            	<th>Fecha de despacho</th>
	            	<td>Origen</td>
	                <th>Notas</th>
									<th>Repite</th>
	                <th>Crear Viaje</th>
									<th>Ignorar</th>
	            </tr>
	        </thead>
			<tbody>
	        	@foreach($prog as $prog)
	            	@if ($prog->despachado)
	            		<tr class="success">
	            	@else
	            		<tr class="danger">
	            	@endif
	            	<td>{{date("d-m-Y H:i", strtotime($prog->fecha_despacho))}}</td>
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
	              <td>{{link_to('prog/progtoviaje/'.$prog->id,'Crear Viaje')}}</td>
	              <td>{{link_to('prog/ignora/'.$prog->id,'Ignorar')}}</td>
	            	</tr>
	            @endforeach
			</tbody>
		</table>
