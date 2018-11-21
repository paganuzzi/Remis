<?php
Route::resource('login','LoginController',['only'=>['index','store']]);

Route::group(array('before'=>'auth'),function(){

		Route::get('salir',function(){
			$log = new Logusuarios;
			$log->nuevolog(0,15);

			Auth::logout();
			return Redirect::to('/');

		});

		Route::get('tiempoespera',function(){
			if (Request::ajax()){
				if (Mobiles::proximoquesale()->count() > 0){
					echo 'Proximo movil '.Mobiles::proximoquesale()[0]['numerocoche'].' | ';
				}
				if (Viajes::maxtiempoviaje()->count() > 0){
					echo 'Promedio viaje '.Viajes::maxtiempoviaje()->max('tiempoviaje').' minutos';
				}
			}else{
				return Redirect::to('/');
			}
		});



		Route::get('/viajes',function(){
			$datos = ['datos' => false];
			return View::make('admin.viajes',$datos);
		});
		Route::post('/viajes',function(){
			$datos = ['datos'=>Viajes::todoviajes(Input::all())];
			return View::make('admin.viajes',$datos);
		});


		Route::resource('/', 'RemisController',['only'=>['index','planilla','reasigna','detalleplanilla','imprdetalleplanilla','imprime_ticket','termina','asignaviaje','asignadestino','destinoviaje','store','borraadeudado','show','destroy']]);

		Route::get('buscamovil/{id}','RemisController@show');

		Route::post('termina/{id}','RemisController@termina');

		Route::post('borraviaje','RemisController@destroy');

		Route::get('borraadeudado/{id}','RemisController@borraadeudado');

		Route::post('asignadestino/{idviaje}','RemisController@asignadestino');
		//asigna mobil
		Route::post('asigna/{idviaje}','RemisController@asignaviaje');
		//reaasigna mobil
		Route::post('reasigna/{idviaje}','RemisController@reasigna');
		//verifica si un viaje tiene destino asigando
		Route::get('destinoviaje/{idviaje}','RemisController@destinoviaje');

		Route::resource('mobil','MobilController',['only'=>['create','store','cierramovil','mobiles_libres','pausamobil','estadomovil']]);

		//cierra un movil
		Route::get('mobil/cierra/{id}','MobilController@cierramovil');

		//imprime ticket de los viajes cuando cierro movil
		Route::get('planilla/imprime/ticket/{id}','RemisController@imprime_ticket');

		Route::get('mobileslibres','MobilController@mobiles_libres');

		Route::get('mobileslibresreasig','MobilController@mobiles_libres_reasigna');

		//combo de moviles libres para pausar
		Route::get('pausamobil','MobilController@pausamobil');

		//pausa movil o lo reactiva
		Route::post('estadomovil','MobilController@estadomovil');

		Route::get('planilla/detalle/{id}','RemisController@detalleplanilla');

		//imprime detalle planilla
		Route::get('planilla/imprime/detalle/{id}','RemisController@imprdetalleplanilla');

		Route::get('planilla', 'RemisController@planilla');

		Route::get('login/destroy','LoginController@destroy');

		Route::get('tiempoviaje','RemisController@index');

		Route::resource('prog','ProgramadosController',['only'=>['create','store','show','edit','update','destroy','ignora','progtoviaje']]);

		Route::resource('sms','SmsController',['only'=>['index','store','edit','update']]);

		Route::get('prog/progtoviaje/{id}','ProgramadosController@progtoviaje');

		Route::get('prog/ignora/{id}','ProgramadosController@ignora');

		Route::group(['before'=>'esadmin'],function(){

			Route::resource('user','UserController',['only'=>['index','create','store','edit','show','update','']]);

			Route::resource('choferes','ChoferesController',['only'=>['index','create','show','store','edit','update']]);

			Route::resource('admin','AdminController',['only'=>['index','store','show']]);

			Route::resource('autos','AutosController',['only'=>['index','create','store','edit','show','update']]);

			//Route::get('estadisticas','EstadisticasController@index');

			Route::resource('estadisticas','EstadisticasController',['only'=>['index','show']]);

			Route::get('estadisticas/detallelog/{id}','EstadisticasController@detallelog');
		});


});
