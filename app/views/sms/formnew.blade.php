<div class="col-md-4">
    <div class="panel panel-default panelenvia">
      <div class="panel-heading">
        <h3 class="panel-title">Crear Mensaje</h3>
      </div>
      <div class="panel-body">
              {{Form::open(array('url' => '/sms','role'=>'form'))}}

              <div class="form-group destinosms">
                {{Form::select('destino',User::where('id','!=',Auth::user()->id)->lists('nombreapellido','id'),0,array('autofocus'=>'autofocus','required'=>'required','class' => 'form-control','placeholder'=>'Para'))}}
              </div>
              <div class="form-group">
                {{Form::textarea('sms',"", array('required'=>'required','class' => 'form-control', 'placeholder' => 'Mensaje'))}}
              </div>

              <div class="row">
                <div class="form-group col-md-4">
                  {{Form::submit('Enviar',['class'=>'form-control btn btn-success enviasms'])}}
                </div>
              </div>
              {{Form::close()}}
      </div>
    </div>
</div>
@include('sms.newsms')
