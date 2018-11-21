<html lang="es">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Iniciar Sesion</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
		 <div class="row">
			<div class="col-xs-10">
	        @if (Session::get('message'))
	                        {{Session::get('message')}}
	        @endif
	      	<form class="form-signin" role="form" method="post">
		        <h2 class="form-signin-heading">Ingreso</h2>
				  <div class="form-group">
		        	<input type="username" class="form-control" placeholder="Nombre de Usuario"  name="username" required="" autofocus="">
				  </div>
				  <div class="form-group">
		        		<input type="password" class="form-control" placeholder="Contraseña"  name="password" required="">
				  </div>
				  <div class="checkbox">
					  <label>
		        		<input type="checkbox" name="recuerda" value="true" class="form-control" />Recordarme
					  </label>
				  </div>
		        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesion</button>
	      	</form>

			</div>
		 </div>
    </div> <!-- /container -->
</body>

</html>
