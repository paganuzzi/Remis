<div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-arrow-left volversms"></span> Responder Mensaje</h3>
      </div>
      <div class="panel-body">
              {{Form::open(array('url' => '/sms/'.$data[0]->id,'role'=>'form','method'=>'put'))}}

                {{Form::hidden('destino',$data[0]->desde)}}

                <div class="form-group">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      {{$data[0]->sms}}
                    </div>
                  </div>
                  {{Form::textarea('sms',"", array('rows'=>'5','required'=>'required','class' => 'form-control', 'autofocus'=>'autofocus'))}}
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    {{Form::submit('Responder',['class'=>'form-control btn btn-success'])}}
                  </div>
                </div>
              {{Form::close()}}
      </div>
    </div>
</div>
