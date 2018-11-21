@extends('menu')
@section('contenido')
        <div class="row">
            <div class="col-md-11">


                <div role="tabpanel">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#despacho" aria-controls="despacho" role="tab" data-toggle="tab">Despacho</a></li>
                    <li role="presentation"><a href="#programa" aria-controls="programa" role="tab" data-toggle="tab">Programar Viajes</a></li>
                    <li role="presentation"><a href="#moviles" aria-controls="moviles" role="tab" data-toggle="tab">Moviles</a></li>
                    <li role="presentation"><a href="#sms" aria-controls="sms" role="tab" data-toggle="tab">Mensajes @if(Sms::smsnoleidos()->count() > 0)<span class="badge"> {{Sms::smsnoleidos()->count()}} </span>@endif</a></li>
                    <li role="presentation"><a href="#otros" aria-controls="otros" role="tab" data-toggle="tab">Otros</a></li>
                  </ul>

                 <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="despacho">
                        <br>

                        <div  class="row">
                          <div class="col-md-4">
                            <div>@if (Session::get('imprime_ticket')){{ '<script>window.open("'.Session::get('imprime_ticket').'","_blank")</script>'}}@endif</div>

                              <span class="pull-right label label-primary tiempoespera" title="Maxima espera de los ultimos 5 viajes"></span>

                            {{Form::open(array('url' => '/','role'=>'form','class'=>'form-horizontal'))}}
                                <div class="form-group">
                                  {{Form::text('origen','',array('autofocus'=>'autofocus','id'=>'origen','onkeyup'=>'origeninput()','required'=>'required','class' => 'form-control','placeholder'=>'Ingrese Origen','tabindex'=>'1'))}}
                                </div>
                                <div class="form-group">
                                  {{Form::text('destino','',array('ng-model'=>'origen','class' => 'form-control','placeholder'=>'Ingrese Destino','tabindex'=>'2'))}}
                                </div>
                                <div class="form-group">
                                  {{Form::select('coche',$mobiles,'0',array('class' => 'form-control','id'=>'coche','tabindex'=>'3'))}}
                                </div>
                          </div>

                          <div class="col-md-3 hidden-xs">
                            <div class="form-group">
                              {{Form::textarea('notas','',array('rows'=>'6','class' => 'form-control','placeholder'=>'Notas','tabindex'=>'4'))}}
                            </div>
                          </div>

                          <div class="col-md-5">
                              <img class="img-responsive hidden-sm hidden-xs" src="images/logo.png" alt="Responsive image">
                          </div>

                        </div>

                        <div class="form-group">
                          {{Form::submit('Crear Viaje',array('class' => 'btn btn-success','onclick'=>'actualiza(true)','tabindex'=>'5'))}}
                        </div>

                        {{Form::close()}}



                        <div id="viajes">
                              @include('actualizatabla')
                        </div>
                    </div><!--tab pannel-->
                    <div role="tabpanel" class="tab-pane" id="programa">
                        <div id="prog">
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="moviles">

                        <div id="pausamobil">
                        </div>

                        <div id="newmobil">

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="sms">
                      <br>
                      <div id="mensages">

                      </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="otros">
                      <br>
                      <div class="row">
                        <div class="col-md-5 notas">
                          <div class="panel panel-default">
                            <div class="panel-heading">Notas</div>
                            <div class="panel-body">
                              {{nl2br(Configuraciones::find(1)->notas)}}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <span class="help-block clickagranda">Click para agrandar</span>
                            <span class="help-block clickachica" style="display:none">Click para achicar</span>
                            <img src="/images/mapa.png" width="100%" class="mapa"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            </div>

        </div><!--row-->


   <!-- Modal -->
   <div class="modal fade" id="buscamovilmodal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title">Movil Buscado</h4>
         </div>
         <div class="modal-body" id="bodybuscamovilmodal">

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal"  >Close</button>
         </div>
       </div>
     </div>
   </div>

    <div class="modal" id="termina">
        <div class="modal-dialog">
            <div class='modal-content'>

                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="titulotermina">Termina Viaje</h4>
                    <h4 class="modal-title" id="titulodestino">Asigna Destino</h4>
                </div>

                <div class='modal-body'>
                    {{Form::open(array('url' => '/termina','role'=>'form','class'=>'termina_form'))}}

                        <div class="form-group">
                          {{Form::label('Destino','Destino')}}
                          {{Form::text('destino','',array('autofocus'=>'autofocus','required'=>'required','class' => 'form-control destino','placeholder'=>'Ingrese Destino'))}}
                          <span class="help-block" id="destinocero">Ingrese 0 para borrar destino actual.</span>
                        </div>

                        <div class="form-group">
                          {{Form::label('monto','Monto')}}
                          {{Form::number('monto','',array('step'=>'any', 'autofocus'=>'autofocus','required'=>'required','class' => 'form-control monto','placeholder'=>'Monto Cobrado'))}}
                        </div>

                        <div class="form-group">
                          {{Form::label('adeuda','¿Adeuda?')}}
                          {{Form::checkbox('adeuda','true')}}
                        </div>

                        <div class="form-group">
                          {{Form::label('notas','Notas')}}
                          {{Form::textarea('notas','',array('class' => 'form-control','placeholder'=>'Notas'))}}
                        </div>

                        <div class="form-group">
                          {{Form::submit('Termina Viaje',array('class' => 'btn btn-success btnmodaltermina'))}}
                        </div>
                        {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="asignamobil">
        <div class="modal-dialog">
            <div class='modal-content'>

                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Asigna viaje a movil</h4>
                </div>

                <div class='modal-body'>
                    {{Form::open(array('url' => '/asigna','role'=>'form','class'=>'asigna_form'))}}

                        <div class="mobileslibres">

                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="reasigna">
        <div class="modal-dialog">
            <div class='modal-content'>

                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Cambia de movil</h4>
                </div>

                <div class='modal-body'>
                    {{Form::open(array('url' => '/reasigna','role'=>'form','class'=>'reasigna_form'))}}

                        <div class="mobileslibres_reasigna">

                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="edit_programa">
        <div class="modal-dialog">
            <div class='modal-content'>

                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editar Programado</h4>
                </div>

                <div class='modal-body'>
                    <div class="div_edit_programa"></div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="progurg">
        <div class="modal-dialog modal-lg">
            <div class='modal-content'>

                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Programados Urgentes</h4>
                </div>

                <div class='modal-body'>
                    <div class="mensage_programados"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="borraviaje" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Borrar Viaje</h4>
          </div>
          <div class="modal-body">
            ¿Borrar el viaje?
          </div>
          <div class="modal-footer">
            <form action="/borraviaje" id="formborraviaje" method="post">
              <input type="hidden" name="idborraviaje" id="idborraviaje" value="" />
              <button type="submit" class="btn btn-primary">Si</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </form>
          </div>
        </div>
      </div>
    </div>


@stop
