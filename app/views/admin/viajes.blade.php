@extends('admin.menuadmin')

@section('contenido')
<div class="col-md-8">
    <ol class="breadcrumb">
        <li><a href="/">Remis</a></li>
        <li class="active">Buscar Viaje</li>
    </ol>

    <h3>Buscar un viaje</h3>
    <div class="row">
      <div class="col-md-4">
          {{Form::open(['url'=>'viajes/','class'=>'form'])}}
            <div class="form-group">
              <input type="text" id="fecha" name="fecha" class="form-control datetime-mio" placeholder="Fecha del viaje"/>
            </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          {{Form::submit('Buscar',['class'=>'form-control btn btn-success'])}}
        </div>
      </div>
    </div>
    {{Form::close()}}


    @if($datos)
        <table class="table table-condensed">
          <thead>
            <tr>
              <th>Fecha Viaje</th>
              <th>Movil</th>
              <th>Chofer</th>
              <th>De</th>
              <th>Hasta</th>
              <th>Monto</th>
              <th>Notas</th>
            </tr>
          </thead>
          <tbody>
              @foreach($datos as $d)
                <tr>
                  <td>{{date('d-m  H:m',strtotime($d->updated_at))}}</td>
                  <td>{{Mobiles::find($d->mobiles_id)->numerocoche}}</td>
                  <td>{{Choferes::find(Mobiles::find($d->mobiles_id)->choferes_id)->nombre}}</td>
                  <td>{{$d->origen}}</td>
                  <td>{{$d->destino}}</td>
                  <td>{{$d->monto}}</td>
                  <td>{{$d->notas}}</td>
                </tr>
              @endforeach
          </tbody>
        </table>
    @endif
</div>
@stop


@section('viaj_active')
    class="active"
@stop
