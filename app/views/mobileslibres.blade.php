@if (count($mobiles)<>0)

    <div class="form-group">
      {{Form::label('coche','Movil')}}
      {{Form::select('coche',$mobiles,'',array('class' => 'form-control asiganamovilselect'))}}
    </div>
    <div class="form-group">
      {{Form::submit('Asignar',array('class' => 'btn btn-success'))}}
    </div>
@else
    <div class="alert alert-danger" role="alert">No posee moviles libres</div>
@endif
