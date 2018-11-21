$(function(){

$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
  e.target // newly activated tab
  e.relatedTarget // previous active tab

  var destino = e.target;
  destino = destino.toString().split('#');

  if (destino[1]=="moviles"){
    actualiza(false);
    $.get('mobil/create',function(data){
        $('#newmobil').html(data);
        });
    $.get('pausamobil',function(datos){
        $('#pausamobil').html(datos);
        });
  };

  if (destino[1]=="sms"){
    actualiza(false);
    $.get('/sms',function(data){
        $('#mensages').html(data);
        });
  };

  if (destino[1]=="programa"){
    actualiza(false);
    $.get('prog/create',function(data){
        $('#prog').html(data);
        $("#fecha_despacho").datetimepicker({
            locale: 'es',
            minDate:Date(),
            showTodayButton:true,
            sideBySide:true,
            format:'D-M-YYYY H:m'
        });
    });
  };
});

$("body").on('click','.mapa',function(){
  var mapa = $('.mapa').hide('fast');
  $('.clickagranda').toggle();
  $('.clickachica').toggle();
  var t = $('.notas').toggle('slow',function(){
    if($(this).css('display')=='none'){
      mapa.width('200%');
    }else{
      mapa.width('100%');
    }
    mapa.show()
  });
})


$("body").on('click','.clickmail',function(event){
  event.preventDefault();
  var id = $(this).attr('idsms');
  $('#mensages').hide('fast');
  $.get('/sms/'+id+'/edit/',function(data){
      $('#mensages').html(data);
      $('#mensages').show('slow');
      });
})

$("body").on('click','.volversms',function(event){
  event.preventDefault();
  $('#mensages').hide('fast');
  $.get('/sms',function(data){
      $('#mensages').html(data);
      $('#mensages').show('slow');
      });
})

$("body").on('click','#buscamovilicono',function (event) {
  event.preventDefault();
  $('#buscamovil').removeClass('hidden');
  $('#numeromovilbuscado').focus();
})

$("body").on('click','.detallelog',function (event) {
  event.preventDefault();
  var id = $(this).attr('href');
  $.get('/estadisticas/detallelog/'+id,function(data){
    $('.detallegastos').html(data);
    $('#detallelogmodal').modal('show');
  })
})

$("body").on('submit','#buscamovil',function(event){
  event.preventDefault();
  actualiza(false);
  var id = $('#numeromovilbuscado').val();
  $.get('/buscamovil/'+id,function(data){
    if (data != 0){
      $('#buscamovil').addClass('hidden');
      $('#numeromovilbuscado').val('');
      $('#bodybuscamovilmodal').html(data);
      $('#buscamovilmodal').modal('show');
    }else {
      $('#buscamovil').addClass('hidden');
      $('#numeromovilbuscado').val('');
      $('#bodybuscamovilmodal').html('<div class="alert alert-info" role="alert">El movil buscado no tiene viajes</div>')
      $('#buscamovilmodal').modal('show');
    }
  })
})

$("body").on('click','.termina_viaje',function(event){
		event.preventDefault();
    actualiza(false);
		$('.termina_form').attr('action',$(this).attr('href'));
        $('#monto').attr('required','required');
        $('.termina_form').trigger("reset");


        $('#titulodestino').addClass('hidden');
        $('#titulotermina').removeClass('hidden');

        $('#destinocero').hide();

        $('label[for=monto]').removeClass('hidden');
        $('#monto').removeClass('hidden');

        $('label[for=adeuda]').removeClass('hidden');
        $('#adeuda').removeClass('hidden');

        $('label[for=notas]').removeClass('hidden');
        $('#notas').removeClass('hidden');

        $('.btnmodaltermina').val('Termina Viaje');

        var idviaje = $(this).attr('href');
        idviaje = idviaje.split('/')[4];
        $.get('destinoviaje/'+idviaje,function(data){
            if (data==0){
                $('.destino').removeAttr('disabled');
                $('.destino').attr('required','required');
                $('.destino').focus();
            }else{
                $('.destino').val(data);
                $('.destino').attr('disabled','disabled');
                $('.monto').focus();
            }
        });

        $('#titulodestino').addClass('hidden');
        $('#termina').modal("show");
        $('.destino').focus();
	});

$("body").on('click','.asigna_mobil',function(event){
        event.preventDefault();
        actualiza(false);
        $.get('mobileslibres',function(data){
        $('.mobileslibres').html(data);
        });
    $('.asigna_form').attr('action',$(this).attr('href'));
    $('#asignamobil').modal("show");
    $('.asiganamovilselect').focus();
});

$("body").on('click','.reasigna_mobil',function(event){
        event.preventDefault();
        actualiza(false);
        $.get('mobileslibresreasig',function(data){
        $('.mobileslibres_reasigna').html(data);
        });
    $('.reasigna_form').attr('action',$(this).attr('href'));
    $('#reasigna').modal("show");
    $('.reasiganamovilselect').focus();
});



$("body").on('click','.edit_prog',function(event){
        event.preventDefault();
        actualiza(false);
        var pepe = $(this).attr('href');
        $.get(pepe,function(data){
          $('.div_edit_programa').html(data);
          $("#fecha_despacho").datetimepicker({
                locale: 'es',
                showTodayButton:true,
                sideBySide:true,
                format:'D-M-YYYY H:m',
            });
        });
        $('#edit_programa').modal("show");
        $("#fecha_despacho").focus();
});


$("body").on('click','.asigna_destino',function(event){
        event.preventDefault();
        actualiza(false);
        $('.termina_form').attr('action',$(this).attr('href'));
        $('#monto').removeAttr('required');
        $('.destino').removeAttr('disabled');
        $('.termina_form').trigger("reset");
        $('#titulodestino').removeClass('hidden');
        $('#titulotermina').addClass('hidden');

        $('#destinocero').show();

        $('label[for=monto]').addClass('hidden');
        $('#monto').addClass('hidden');

        $('label[for=adeuda]').addClass('hidden');
        $('#adeuda').addClass('hidden');

        $('label[for=notas]').addClass('hidden');
        $('#notas').addClass('hidden');

        $('.btnmodaltermina').val('Asigna Destino');

        $('#termina').modal("show");
        $('.destino').focus();
});

$('body').on('click','.detalleplanilla',function(event){
    event.preventDefault();
    var pepe = $(this).attr('href');

    $.get(pepe,function(data){
      $('.bodyviajes_coche').html(data);
    });

    $('#viajes_coche').modal('show');
});

$('body').on('click','.cierra_movil',function(event){
    event.preventDefault();
    var link = $(this).attr('href');
    $('#link_cierra_movil').attr('href',link);
    $('#cierra_modal').modal('show');
})

$('body').on('click','.borraviaje',function(event){
  event.preventDefault();
  actualiza(false);
  var id = $(this).attr('href');
  $('#idborraviaje').attr('value',id);
  $('#borraviaje').modal('show');
})

$('body').on('click','.borraviajeadeudadoclick',function(event){
  event.preventDefault();
  var id = $(this).attr('href');
  $('.siborraviajeadeudado').attr('href',id);
  $('#borraviajeadeudado').modal('show');
})

$('body').on('click','.borraprog',function(event){
  event.preventDefault();
  actualiza(false);
  var pepe = $(this).attr('href');
  $.get(pepe,function(data){
    $('.div_edit_programa').html(data);
    $("#fecha_despacho").datetimepicker({
          locale: 'es',
          showTodayButton:true,
          minDate:Date(),
          sideBySide:true,
          format:'D-M-YYYY H:m',
      });
    $('#formactuprog').addClass('hidden');
  });
  $('#edit_programa').modal('show');
})

$('body').on('hidden.bs.modal',function(){
  actualiza(true);
})
});

function ocultabuscamovil(){
  $('#buscamovil').addClass('hidden');
  $('#numeromovilbuscado').val('');
}

function origeninput(){
  //si escribe algo ya no permite actualizar si lo borra ya si
  var origenvacio = $('#origen').val();
  if (origenvacio.length == 0){
    actualiza(true);
  }else {
    actualiza(false);
  }
}

function actualiza(valor){
  if (valor){
    window.localStorage.setItem('actualiza','true');
  }else {
    window.localStorage.setItem('actualiza','false');
  }
}
