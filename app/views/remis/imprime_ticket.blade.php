<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Remis Ola</title>
	    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	</head>
@if ($data)
	<script language="javascript">
				 function imprime(){
						window.print();
						setTimeout(function(){window.close();}, 15);
				}
   </script>
	<body class="container" onload="imprime()">
		<div class="row">
			<div class="col-xs-6">

				<h4>Copia para el Chofer {{Carbon::now()->format('d-m-Y h:i:s A')}}</h4>

				@include('remis.tablas_ticket.viajes')
				@if ($logremis->count() > 0)
					@include('remis.tablas_ticket.gastos')
				@endif
				<br><br>
	        	<h3>-------------------------------------------<br>Firma del Chofer</h3>
	        	<br>
	        	<br>
	        	<h3>-------------------------------------------<br>Firma la Agencia</h3>


				<hr />

	        	<h4>Copia para la Agencia {{Carbon::now()->format('d-m-Y h:i:s A')}}</h4>

				@include('remis.tablas_ticket.viajes')
				@if ($logremis->count() > 0)
					@include('remis.tablas_ticket.gastos')
				@endif


	        	<br><br>
	        	<h3>-------------------------------------------<br>Firma del Chofer</h3>
	        	<br>
	        	<br>
	        	<h3>-------------------------------------------<br>Firma la Agencia</h3>

			</div>
        </div>
	</body>
</html>
@else
<body class="container">
	<script>setTimeout(function(){window.close();}, 5000);</script>
	<div class="alert alert-info" style="margin-top:5em;">El movil no realizo viajes</div>
</body>
@endif
