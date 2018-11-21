<!DOCTYPE html>
<html lang="es">
	<head>
	    <title>Remis Ola-Administracion</title>
	    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	    <script type="text/javascript" src="/js/jquery.js"></script>
	    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
		 <script type="text/javascript" src="/js/moment-with-locales.min.js"></script>
		 <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
		 <script type="text/javascript" src="/js/datetime-mio.js"></script>
		 <script type="text/javascript" src="/js/canvasjs.min.js"></script>
	    <script type="text/javascript" src="/js/mio.js"></script>
	</head>
	<body>
		<div class="container">
      <div class="row">
            <div class="col-md-11">
			   	@include('barramenu')
            </div>
      </div>
				@if(Auth::user()->usertype == 0)
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav nav-pills nav-stacked">
                        <li @yield('us_active')><a href="@yield('urlusu','/user')">@yield('monusu','Usuarios')</a></li>
                        <li @yield('op_active')><a href="/admin">Opciones de Sistema</a></li>
                        <li @yield('est_active')><a href="/estadisticas">Estadisticas</a></li>
                        <li @yield('aut_active')><a href="/autos"> @yield('menuautos','Coches')@include('admin.aviso.vencecoche')</a></li>
                        <li @yield('chof_active')><a href="/choferes">@yield('menuchofer','Choferes')@include('admin.aviso.vencechofer')</a></li>
                        <li @yield('viaj_active')><a href="/viajes">@yield('menuviajes','Viajes')</a></li>
                    </ul>
                </div>
				@endif
                @yield('contenido')
				 </div>



		</div><!--container-->
	</body>
</html>
