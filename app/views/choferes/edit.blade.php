@extends('admin.menuadmin')
@section('contenido')
        <div class="col-md-10">
					<ol class="breadcrumb">
    					<li><a href="/">Remis</a></li>
						<li><a href="/choferes">Choferes</a></li>
						<li  class="active">Edicion</li>
					</ol>

					{{Form::open(array('url' => '/choferes/'.$data->id,'role'=>'form','method'=>'put'))}}


				    <div class="form-group">
				        {{Form::label('nombre', 'Nombre del Chofer', array('class' => 'control-label'))}}
				        {{Form::text('nombre',$data->nombre, array('class' => 'form-control', 'placeholder' => 'Nombre del Chofer','autofocus'=>'autofocus'))}}
				    </div>
				    @if($errors->has('nombre'))<div class="alert alert-danger form-group" id="error">{{$errors->first('nombre')}}</div>@endif

					<div class="form-group">
				        {{Form::label('dni', 'DNI del chofer', array('class' => 'control-label'))}}
				        {{Form::text('dni',$data->dni, array('class' => 'form-control', 'placeholder' => 'DNI del chofer'))}}
				    </div>
				    @if($errors->has('dni'))<div class="alert alert-danger form-group" id="error">{{$errors->first('dni')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('fechanac', 'Fecha Nacimiento', array('class' => 'control-label'))}}
				        {{Form::text('fechanac',date("d-m-Y",strtotime($data->fechanac)), array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha Nacimiento'))}}
				    </div>
				    @if($errors->has('fechanac'))<div class="alert alert-danger form-group" id="error">{{$errors->first('fechanac')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('telefono', 'Telefono del chofer', array('class' => 'control-label'))}}
				        {{Form::text('telefono',$data->telefono, array('class' => 'form-control', 'placeholder' => 'Telefono del chofer'))}}
				    </div>
				    @if($errors->has('telefono'))<div class="alert alert-danger form-group" id="error">{{$errors->first('telefono')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('direccion', 'Direccion del chofer', array('class' => 'control-label'))}}
				        {{Form::text('direccion',$data->telefono, array('class' => 'form-control', 'placeholder' => 'Direccion del chofer'))}}
				    </div>
				    @if($errors->has('direccion'))<div class="alert alert-danger form-group" id="error">{{$errors->first('direccion')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('numlicencia', 'Numero de licencia de conductor', array('class' => 'control-label'))}}
				        {{Form::text('numlicencia',$data->numlicencia, array('class' => 'form-control', 'placeholder' => 'Numero de licencia de conductor'))}}
				    </div>
				    @if($errors->has('numlicencia'))<div class="alert alert-danger form-group" id="error">{{$errors->first('numlicencia')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('otorgamiento', 'Fecha en que se otorgo la licencia', array('class' => 'control-label'))}}
				        {{Form::text('otorgamiento',date("d-m-Y",strtotime($data->otorgamiento)), array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha en que se otorgo la licencia'))}}
				    </div>
				    @if($errors->has('otorgamiento'))<div class="alert alert-danger form-group" id="error">{{$errors->first('otorgamiento')}}</div>@endif

					<div class="form-group">
				        {{Form::label('vencimiento', 'Fecha de veciemiento de la licencia', array('class' => 'control-label'))}}
				        {{Form::text('vencimiento',date("d-m-Y",strtotime($data->vencimiento)), array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha de veciemiento de la licencia'))}}
				    </div>
				    @if($errors->has('vencimiento'))<div class="alert alert-danger form-group" id="error">{{$errors->first('vencimiento')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('clases', 'Clases habilitadas para manejar', array('class' => 'control-label'))}}
				        {{Form::text('clases',$data->clases, array('class' => 'form-control', 'placeholder' => 'Clases habilitadas para manejar'))}}
				    </div>
				    @if($errors->has('clases'))<div class="alert alert-danger form-group" id="error">{{$errors->first('clases')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('grupofactor', 'Grupo y factor sanguineo', array('class' => 'control-label'))}}
				        {{Form::text('grupofactor',$data->grupofactor, array('class' => 'form-control', 'placeholder' => 'Grupo y factor sanguineo'))}}
				    </div>
				    @if($errors->has('grupofactor'))<div class="alert alert-danger form-group" id="error">{{$errors->first('grupofactor')}}</div>@endif

					<div class="form-group">
				        {{Form::label('restricciones', 'Restricciones para conducir', array('class' => 'control-label'))}}
				        {{Form::text('restricciones',$data->restricciones, array('class' => 'form-control', 'placeholder' => 'Restricciones para conducir'))}}
				    </div>
				    @if($errors->has('restricciones'))<div class="alert alert-danger form-group" id="error">{{$errors->first('restricciones')}}</div>@endif

				    <div class="form-group">
				    	@if ($data->asignado)
				    		<div class="alert alert-danger" role="alert">El chofer esta asignado y no lo puede deshabilitar</div>
				    	@else
				        	{{Form::label('estado', '¿El chofer esta habilitado?', array('class' => 'control-label'))}}
				        	{{Form::checkbox('estado',$data->estado,$data->estado, array('placeholder' => '¿El chofer esta habilitado?'))}}
				    	@endif
				    </div>
				    @if($errors->has('estado'))<div class="alert alert-danger form-group" id="error">{{$errors->first('estado')}}</div>@endif

				    <div class="form-group">
				        {{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
				    </div>

				    {{Form::close()}}
    </div>
@stop()
@section('chof_active')
    class="active"
@stop

@section('menuchofer')
	Editando Chofer
@stop
