@extends('admin.menuadmin')
@section('contenido')

<div class="col-md-offset-3">
                	<ol class="breadcrumb">
                        <li><a href="/">Remis</a></li>
                        <li><a href="/user">Usuarios</a></li>
                        <li class="active">Nuevo</li>
                    </ol>

                	<div id="message">
                            @if (Session::get('message'))
                                    {{Session::get('message')}}
                            @endif
                    </div>
					{{Form::open(array('url' => '/user','role'=>'form'))}}


				    <div class="form-group">
				        {{Form::label('nombreapellido', 'Nombre y apellido', array('class' => 'control-label'))}}
				        {{Form::text('nombreapellido',"", array('class' => 'form-control', 'placeholder' => 'Nombre y apellido','autofocus'=>'autofocus'))}}
				    </div>
				    @if($errors->has('nombreapellido'))<div class="alert alert-danger form-group" id="error">{{$errors->first('nombreapellido')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('username', 'Nombre de usuario', array('class' => 'control-label'))}}
				        {{Form::text('username',"", array('class' => 'form-control', 'placeholder' => 'Nombre de usuario'))}}
				    </div>
				    @if($errors->has('username'))<div class="alert alert-danger form-group" id="error">{{$errors->first('username')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('password', 'Contraseña', array('class' => 'control-label'))}}
				        {{Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña'))}}
				    </div>
				    @if($errors->has('password'))<div class="alert alert-danger form-group" id="error">{{$errors->first('password')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('repassword', 'Repita contraseña', array('class' => 'control-label'))}}
				        {{Form::password('repassword', array('class' => 'form-control', 'placeholder' => 'Repita contraseña'))}}
				    </div>
				    @if($errors->has('repassword'))<div class="alert alert-danger form-group" id="error">{{$errors->first('repassword')}}</div>@endif

				    <div class="form-group">
				        {{Form::label('email', 'Correo electronico', array('class' => 'control-label'))}}
				        {{Form::text('email',"", array('class' => 'form-control', 'placeholder' => 'Correo electronico'))}}
				    </div>
				    @if($errors->has('email'))<div class="alert alert-danger form-group" id="error">{{$errors->first('email')}}</div>@endif

            <div class="form-group">
                {{Form::label('usertype', 'Tipo de Usuario', array('class' => 'control-label'))}}
                {{Form::select('usertype',['Administrador','Usuario'],1,array('class' => 'form-control'))}}
            </div>

				    <div class="form-group">
				        {{Form::label('active', '¿El usuario esta habilitado?', array('class' => 'control-label'))}}
				        {{Form::checkbox('active',false, array('placeholder' => '¿El usario esta habilitado?'))}}
				    </div>
				    @if($errors->has('active'))<div class="alert alert-danger form-group" id="error">{{$errors->first('active')}}</div>@endif

				    <div class="form-group">
				        {{Form::submit('Guardar', array('class' => 'btn btn-success'))}}
				    </div>

				    {{Form::close()}}
                </div>
            </div>
@stop

@section('us_active')
	class="active"
@stop

@section('monusu')
	Nuevo usuario
@stop

@section('urlusu')
	/user
@stop
