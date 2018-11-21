<div class="row">
	<div class="col-md-7">
		<h3>Programar Viaje</h3>

		{{Form::open(array('url' => '/prog','role'=>'form'))}}

		<div class="form-group">
			{{Form::label('fecha_despacho', 'Fecha y hora del pedido', ['class' => 'control-label'])}}
			{{Form::text('fecha_despacho',"", array('required'=>'required','class' => 'form-control', 'placeholder' => 'Fecha y hora del pedido','autofocus'=>'autofocus'))}}
		</div>
		@if($errors->has('fecha_despacho'))<div class="alert alert-danger form-group" id="error">{{$errors->first('fecha_despacho')}}</div>@endif

		<div class="form-group">
			{{Form::label('origen', 'Origen', array('class' => 'control-label'))}}
			{{Form::text('origen',"", array('class' => 'form-control', 'placeholder' => 'Ingrese Origen','required'=>'required'))}}
		</div>
		@if($errors->has('origen'))<div class="alert alert-danger form-group" id="error">{{$errors->first('origen')}}</div>@endif

		<div class="form-group">
			{{Form::label('repite', 'Repeticion', array('class' => 'control-label'))}}
			{{Form::select('repite',[null,'Dia','Semana','Dias habiles'],'0',array('class' => 'form-control'))}}
		</div>
		@if($errors->has('repite'))<div class="alert alert-danger form-group" id="error">{{$errors->first('repite')}}</div>@endif

		<div class="form-group">
			{{Form::label('notas', 'Notas', array('class' => 'control-label'))}}
			{{Form::textarea('notas',"", array('rows'=>'3','cols'=>'45','class' => 'form-control', 'placeholder' => 'Notas'))}}
		</div>
		@if($errors->has('notas'))<div class="alert alert-danger form-group" id="error">{{$errors->first('notas')}}</div>@endif

		<div class="form-group">
			{{Form::submit('Programar', array('class' => 'btn btn-success'))}}
		</div>

		{{Form::close()}}
	</div>
</div>
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
	            	@if ($prog->despachado)
	            		<tr class="success">
	            	@else
	            		<tr class="danger">
	            	@endif
	            	<td>{{date("d-m H:i", strtotime($prog->fecha_despacho))}}</td>
	            	<td>{{$prog->origen}}</td>
	                <td>{{$prog->notas}}</td>
	                <td>
	                	@if ($prog->despachado)
	                		despachado a las {{date('d-m-y H:i',strtotime($prog->deleted_at))}}
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
		<a href="/prog/create/" class="btn btn-info">Ver Mas</a>
	</div>
</div>
