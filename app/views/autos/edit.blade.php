@extends('admin.menuadmin')
@section('contenido')
                <div class="col-md-10">
                	<ol class="breadcrumb">
                        <li><a href="/">Remis</a></li>
                        <li><a href="/autos">Autos</a></li>
                        <li class="active">Edicion</li>
                    </ol>


					{{Form::open(array('url' => '/autos/'.$data->id,'role'=>'form','method'=>'put'))}}


				    <div class="form-group">
				        {{Form::label('marca', 'Marca del auto', array('class' => 'control-label'))}}
				        {{Form::text('marca',$data->marca, array('class' => 'form-control', 'placeholder' => 'Marca del Coche','autofocus'=>'autofocus'))}}
				    </div>
				    @if($errors->has('marca'))<div class="alert alert-danger form-group" id="error">{{$errors->first('marca')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('modelo', 'Modelo del auto', array('class' => 'control-label'))}}
				        {{Form::text('modelo',$data->modelo, array('class' => 'form-control', 'placeholder' => 'Modelo del Coche'))}}
				    </div>
				    @if($errors->has('modelo'))<div class="alert alert-danger form-group" id="error">{{$errors->first('modelo')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('patente', 'Patente del auto', array('class' => 'control-label'))}}
				        {{Form::text('patente',$data->patente, array('class' => 'form-control', 'placeholder' => 'Patente del Auto'))}}
				    </div>
				    @if($errors->has('patente'))<div class="alert alert-danger form-group" id="error">{{$errors->first('patente')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('aseguradora', 'Aseguradora', array('class' => 'control-label'))}}
				        {{Form::text('aseguradora',$data->aseguradora, array('class' => 'form-control', 'placeholder' => 'Aseguradora del Auto'))}}
				    </div>
				    @if($errors->has('aseguradora'))<div class="alert alert-danger form-group" id="error">{{$errors->first('aseguradora')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('vencimiento', 'Fecha de vencimiento del seguro', array('class' => 'control-label'))}}
				        {{Form::text('vencimiento',date("d-m-Y",strtotime($data->vencimiento)), array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha de vencimiento del seguro'))}}
				    </div>
				    @if($errors->has('vencimiento'))<div class="alert alert-danger form-group" id="error">{{$errors->first('vencimiento')}}</div>@endif

					<div class="form-group">
				        {{Form::label('numhabilitacion', 'Numero de habilitacion del auto', array('class' => 'control-label'))}}
				        {{Form::text('numhabilitacion',$data->numhabilitacion, array('class' => 'form-control', 'placeholder' => 'Numero de habilitacion del auto'))}}
				    </div>
				    @if($errors->has('numhabilitacion'))<div class="alert alert-danger form-group" id="error">{{$errors->first('numhabilitacion')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('vencehabilitacion', 'Fecha de vencimiento de habilitacion', array('class' => 'control-label'))}}
				        {{Form::text('vencehabilitacion',date("d-m-Y",strtotime($data->vencehabilitacion)), array('class' => 'form-control datetime-mio', 'placeholder' => 'Fecha de vencimiento de habilitacion'))}}
				    </div>
				    @if($errors->has('vencehabilitacion'))<div class="alert alert-danger form-group" id="error">{{$errors->first('vencehabilitacion')}}</div>@endif

				    <div class="form-group">
				    	@if ($data->asignado)
				    		<div class="alert alert-danger" role="alert">El coche esta asignado y no lo puede deshabilitar</div>
				    	@else
				        	{{Form::label('estado', '¿El coche esta habilitado?', array('class' => 'control-label'))}}
				        	{{Form::checkbox('estado',$data->estado,$data->estado, array('placeholder' => '¿El coche esta habilitado?'))}}
				    	@endif
				    </div>
				    @if($errors->has('estado'))<div class="alert alert-danger form-group" id="error">{{$errors->first('estado')}}</div>@endif

				    <div class="form-group">
				        {{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
				    </div>

				    {{Form::close()}}
        </div>
@stop

@section('aut_active')
    class="active"
@stop

@section('menuautos')
	Editando Auto
@stop
