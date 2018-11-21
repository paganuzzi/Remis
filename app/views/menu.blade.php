<!DOCTYPE html>
<html lang="es">
<head>
    <title>Remis Ola</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/tab.js"></script>
    <script type="text/javascript" src="/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/js/transition.js"></script>
    <script type="text/javascript" src="/js/collapse.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/mio.js"></script>
    <script type="text/javascript" src="/js/socket.io.js"></script>
    <meta name="refresh" content="60">
</head>

<script type="text/javascript">
var socket = io.connect('http://remis.test:8080');
      socket.on('connect_error',function(){
         $('.container').html('<div class="alert alert-danger" role="alert"><b>Error en el servidor</b></div>');
      })

      socket.on('reconnect',function(){
         $('.container').html('<div class="alert alert-success" role="alert"><b>Servidor nuevamente online recargando....</b></div>');

         setTimeout(function(){
            window.location.reload();
         },3000);
      })

      socket.on('actualizar',function(){
         $.get('/tiempoviaje',function(data){
             $('#viajes').html(data);
         })
         $.get('/tiempoespera',function(data){
            $('.tiempoespera').html(data);
         })
         $.get('/')
         .fail(function(){
             $('.container').html('<div class="alert alert-danger" role="alert">Error de conexion</div>');
         });

         $.get('/prog/1',function(data){
             if (data.length > 1){
                 $('.mensage_programados').html(data);
                 $('#progurg').modal("show");
             }
             })
      });

      socket.on('actualiza_pagina',function(){
         var actualiza = window.localStorage.getItem('actualiza');
         if (actualiza == 'true'){
            window.location.reload();
         }else {
            $('#message').html('<div class="alert alert-info" role="alert"><a onclick="location.reload()" href="/">Otro usuario realizo cambios Actualizar!!!!</a></div>');
            $('#message').show();
         }
      });
</script>


<body onunload="socket.emit('termina_viaje')" onload="actualiza(true);">

    <div class="container">
      <div style="position:absolute !important;" class="col-xs-offset-4 text-center">
         <script>
         setTimeout(function(){$('#message').hide()},8000)
         </script>
         <div id="message">
         @if (Session::get('message')){{Session::get('message')}}@endif
         </div>
      </div>
         @include('barramenu')

         @yield('contenido')
    </div><!--fin container-->

</body>

</html>
