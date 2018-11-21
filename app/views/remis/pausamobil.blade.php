
<div class="col-md-5">
	<br>
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Editar Movil</h3>
	  </div>
	  <div class="panel-body">
			@if (count($mobiles)<>0)
				{{Form::open(array('url' => '/estadomovil','role'=>'form'))}}

					<div class="form-group">
						{{Form::label('coche','Movil')}}
						<b>{{Form::select('movilpausa',$mobiles,'',array('class' => 'form-control','id'=>'movilpausa'))}}</b>
					</div>


					<div	class="form-group">
						{{Form::label('detalle','Detalle')}}
						{{Form::textarea('detalle','',array('rows'=>'3','cols'=>'45','class'=>'form-control'))}}
					</div>

					<div class="form-group">
					{{Form::label('gastos','Gastos del Movil')}}
					{{Form::number('gastos','',array('step'=>'any', 'autofocus'=>'autofocus','class' => 'form-control monto','placeholder'=>'Monto Cobrado'))}}
					</div>

					<div class="form-group">
						{{Form::label('cierra','Cierra movil')}}
						{{Form::checkbox('cierra', 'cierra', false)}}
					</div>

					<div class="form-group">
						{{Form::submit('Pausar/Activar',['class' => 'btn btn-success'])}}
					</div>
				{{Form::close()}}
			@else
					<div class="alert alert-danger" role="alert">No posee moviles libres</div>
			@endif
	  </div>
	</div>

</div>
