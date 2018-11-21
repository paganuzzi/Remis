
	{{Form::open(array('url' => '/prog/'.$datos->id,'role'=>'form','method'=>'put','id'=>'formactuprog'))}}

	<div class="form-group">
		{{Form::label('fecha_despacho', 'Fecha y hora del pedido', array('class' => 'control-label'))}}
		{{Form::text('fecha_despacho',date("d-m-Y H:i",strtotime($datos->fecha_despacho)), array('class' => 'form-control', 'placeholder' => 'Fecha y hora del pedido','autofocus'=>'autofocus'))}}
	</div>
	@if($errors->has('fecha_despacho'))<div class="alert alert-danger form-group" id="error">{{$errors->first('fecha_despacho')}}</div>@endif

	<div class="form-group">
		{{Form::label('origen', 'Origen', array('class' => 'control-label'))}}
		{{Form::text('origen',$datos->origen, array('class' => 'form-control', 'placeholder' => 'Ingrese Origen'))}}
	</div>
	@if($errors->has('origen'))<div class="alert alert-danger form-group" id="error">{{$errors->first('origen')}}</div>@endif

	<div class="form-group">
		{{Form::label('repite', 'Repeticion', array('class' => 'control-label'))}}
		{{Form::select('repite',[null,'Dia','Semana','Dias habiles'],$datos->repite,array('class' => 'form-control'))}}
	</div>
	@if($errors->has('repite'))<div class="alert alert-danger form-group" id="error">{{$errors->first('repite')}}</div>@endif


	<div class="form-group">
		{{Form::label('notas', 'Notas', array('class' => 'control-label'))}}
		{{Form::textarea('notas',$datos->notas, array('rows'=>'3','cols'=>'45','class' => 'form-control', 'placeholder' => 'Notas'))}}
	</div>
	@if($errors->has('notas'))<div class="alert alert-danger form-group" id="error">{{$errors->first('notas')}}</div>@endif

	<div class="form-group">
		{{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
	</div>

	{{Form::close()}}

	{{Form::open(array('url' => '/prog/'.$datos->id,'role'=>'form','method'=>'delete'))}}
		<div class="form-group">
			{{Form::submit('Eliminar', array('class' => 'btn btn-danger'))}}
		</div>
	{{Form::close()}}
