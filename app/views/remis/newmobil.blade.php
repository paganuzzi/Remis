<div class="col-md-6">
	<br>
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Crear Movil</h3>
	  </div>
	  <div class="panel-body">
			@if (count($coche)<>0 and count($choferes)<>0)

			{{Form::open(array('url' => '/mobil','role'=>'form','class'=>'termina_form'))}}

			<div class="form-group">
				{{Form::label('nombre','Nombre Movil')}}
				{{Form::text('nombre','',array('autofocus'=>'autofocus','required'=>'required','class' => 'form-control','placeholder'=>'Nombre del movil a crear'))}}
			</div>

			<div class="form-group">
				{{Form::label('idcoche','Coche')}}
				<b>{{Form::select('idcoche',$coche,'0',array('class' => 'form-control'))}}</b>
			</div>

			<div class="form-group">
				{{Form::label('idchofer','Chofer')}}
				<b>{{Form::select('idchofer',$choferes,'0',array('class' => 'form-control'))}}</b>
			</div>

			<div class="form-group">
				{{Form::submit('Crear',array('class' => 'btn btn-success'))}}
			</div>
			{{Form::close()}}

		@endif

		@if (count($coche) === 0)
			<div class="alert alert-danger" role="alert">Todos los coches estan asignados a Moviles</div>
		@endif

		@if (count($choferes) === 0)
			<div class="alert alert-danger" role="alert">Todos los choferes estan asignados a Moviles</div>
		@endif
	  </div>
	</div>
</div>
