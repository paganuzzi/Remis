@extends('admin.menuadmin')
@section('contenido')

        <div class="col-md-10">

  					<ol class="breadcrumb">
      					<li><a href="/">Remis</a></li>
  						<li><a href="/choferes">Choferes</a></li>
  						<li  class="active">Nuevo</li>
  					</ol>

					{{Form::open(array('url' => '/choferes','role'=>'form'))}}


				    <div class="form-group">
				        {{Form::label('nombre', 'Nombre del chofer', array('class' => 'control-label'))}}
				        {{Form::text('nombre',"", array('class' => 'form-control', 'placeholder' => 'Nombre del chofer','autofocus'=>'autofocus'))}}
				    </div>
				    @if($errors->has('nombre'))<div class="alert alert-danger form-group" id="error">{{$errors->first('nombre')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('dni', 'DNI del chofer', array('class' => 'control-label'))}}
				        {{Form::text('dni',"", array('class' => 'form-control', 'placeholder' => 'DNI del chofer'))}}
				    </div>
				    @if($errors->has('dni'))<div class="alert alert-danger form-group" id="error">{{$errors->first('dni')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('fechanac', 'Fecha Nacimiento', array('class' => 'control-label'))}}
				        {{Form::text('fechanac',"", array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha Nacimiento'))}}
				    </div>
				    @if($errors->has('fechanac'))<div class="alert alert-danger form-group" id="error">{{$errors->first('fechanac')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('telefono', 'Telefono del chofer', array('class' => 'control-label'))}}
				        {{Form::text('telefono',"", array('class' => 'form-control', 'placeholder' => 'Telefono del chofer'))}}
				    </div>
				    @if($errors->has('telefono'))<div class="alert alert-danger form-group" id="error">{{$errors->first('telefono')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('direccion', 'Direccion del chofer', array('class' => 'control-label'))}}
				        {{Form::text('direccion',"", array('class' => 'form-control', 'placeholder' => 'Direccion del chofer'))}}
				    </div>
				    @if($errors->has('direccion'))<div class="alert alert-danger form-group" id="error">{{$errors->first('direccion')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('numlicencia', 'Numero de licencia de conductor', array('class' => 'control-label'))}}
				        {{Form::text('numlicencia',"", array('class' => 'form-control', 'placeholder' => 'Numero de licencia de conductor'))}}
				    </div>
				    @if($errors->has('numlicencia'))<div class="alert alert-danger form-group" id="error">{{$errors->first('numlicencia')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('otorgamiento', 'Fecha en que se otorgo la licencia', array('class' => 'control-label'))}}
				        {{Form::text('otorgamiento',"", array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha en que se otorgo la licencia'))}}
				    </div>
				    @if($errors->has('otorgamiento'))<div class="alert alert-danger form-group" id="error">{{$errors->first('otorgamiento')}}</div>@endif

					<div class="form-group">
				        {{Form::label('vencimiento', 'Fecha de veciemiento de la licencia', array('class' => 'control-label'))}}
				        {{Form::text('vencimiento',"", array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha de veciemiento de la licencia'))}}
				    </div>
				    @if($errors->has('vencimiento'))<div class="alert alert-danger form-group" id="error">{{$errors->first('vencimiento')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('clases', 'Clases habilitadas para manejar', array('class' => 'control-label'))}}
				        {{Form::text('clases',"", array('class' => 'form-control', 'placeholder' => 'Clases habilitadas para manejar'))}}
				    </div>
				    @if($errors->has('clases'))<div class="alert alert-danger form-group" id="error">{{$errors->first('clases')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('grupofactor', 'Grupo y factor sanguineo', array('class' => 'control-label'))}}
				        {{Form::text('grupofactor',"", array('class' => 'form-control', 'placeholder' => 'Grupo y factor sanguineo'))}}
				    </div>
				    @if($errors->has('grupofactor'))<div class="alert alert-danger form-group" id="error">{{$errors->first('grupofactor')}}</div>@endif

					<div class="form-group">
				        {{Form::label('restricciones', 'Restricciones para conducir', array('class' => 'control-label'))}}
				        {{Form::text('restricciones',"", array('class' => 'form-control', 'placeholder' => 'Restricciones para conducir'))}}
				    </div>
				    @if($errors->has('restricciones'))<div class="alert alert-danger form-group" id="error">{{$errors->first('restricciones')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('estado', '¿El chofer esta habilitado?', array('class' => 'control-label'))}}
				        {{Form::checkbox('estado','false', array('class' => 'form-control', 'placeholder' => '¿El chofer esta habilitado?'))}}
				    </div>
				    @if($errors->has('estado'))<div class="alert alert-danger form-group" id="error">{{$errors->first('estado')}}</div>@endif

				    <div class="form-group">
				        {{Form::submit('Agregar', array('class' => 'btn btn-success'))}}
				    </div>

				    {{Form::close()}}
      </div>
      </div><!--dil col md-6-->
@stop()
@section('chof_active')
    class="active"
@stop

@section('menuchofer')
	Creando Chofer
@stop
