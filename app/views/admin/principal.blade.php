@extends('admin.menuadmin')


@section('contenido')
<div class="col-md-10">

                <ol class="breadcrumb">
                        <li><a href="/">Remis</a></li>
                        <li class="active">Opciones del sistema</li>
                </ol>

                  @if (Session::get('message'))
                            {{Session::get('message')}}
                    @endif

                    {{Form::open(array('url' => '/admin','role'=>'form'))}}

                    <div class="form-group">
                        {{Form::label('nombreremis','Nombre de la Remiseria', array('class' => 'control-label'))}}
                        {{Form::text('nombreremis',$config->nombreremis,array('class' => 'form-control','placeholder'=>'Nombre de la Remiseria'))}}
                    </div>
                    @if($errors->has('nombreremis'))<div class="alert alert-danger form-group" id="error">{{$errors->first('nombreremis')}}</div>@endif

                    <div class="form-group">
                        {{Form::label('porcentaje','Porcentaje Remiseria', array('class' => 'control-label'))}}
                        {{Form::text('porcentaje',$config->porcentaje_remisera,array('class' => 'form-control','placeholder'=>'Porcentaje de la Remisera sobre los Viajes'))}}
                    </div>
                    @if($errors->has('porcentaje'))<div class="alert alert-danger form-group" id="error">{{$errors->first('porcentaje')}}</div>@endif

                    <div class="form-group">
                        {{Form::label('notas','Notas generales', array('class' => 'control-label'))}}
                        {{Form::textarea('notas',$config->notas,array('class' => 'form-control','placeholder'=>'Notas generales'))}}
                    </div>
                    @if($errors->has('notas'))<div class="alert alert-danger form-group" id="error">{{$errors->first('notas')}}</div>@endif

                    <div class="form-group">
                        {{Form::label('tiempomaxviaje','Tiempo Maximo de un Viaje', array('class' => 'control-label'))}}
                        {{Form::text('tiempomaxviaje',$config->tiempomaxviaje,array('class' => 'form-control datetime-mio-tiempo','placeholder'=>'Tiempo maximo que puede durar un viaje'))}}
                    </div>
                    @if($errors->has('tiempomaxviaje'))<div class="alert alert-danger form-group" id="error">{{$errors->first('tiempomaxviaje')}}</div>@endif

                    <div class="form-group">
                        {{Form::label('avisovenceseguro','Tiempo en dias para el vencimiento del Seguro/Habilitacion auto', array('class' => 'control-label'))}}
                        {{Form::text('avisovenceseguro',$config->avisovenceseguro,array('class' => 'form-control','placeholder'=>'Tiempo en dias para el vencimiento del Seguro/Habilitacion del auto'))}}
                    </div>
                    @if($errors->has('avisovenceseguro'))<div class="alert alert-danger form-group" id="error">{{$errors->first('avisovenceseguro')}}</div>@endif

                    <div class="form-group">
                        {{Form::label('avisovencechofer', 'Tiempo en dias para el vencimiento de la  habilitacion del chofer', array('class' => 'control-label'))}}
                        {{Form::text('avisovencechofer',$config->avisovencechofer, array('class' => 'form-control', 'placeholder' => 'Tiempo en dias para el vencimiento de la  habilitacion del chofer'))}}
                    </div>
                    @if($errors->has('avisovencechofer'))<div class="alert alert-danger form-group" id="error">{{$errors->first('avisovencechofer')}}</div>@endif

                    <div class="form-group">
                        {{Form::submit('Guardar',array('class' => 'btn btn-success'))}}
                    </div>
                    {{Form::close()}}
</div>
@stop()

@section('op_active')
    class="active"
@stop
