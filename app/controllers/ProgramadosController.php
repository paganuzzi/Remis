<?php

class ProgramadosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */





	public function create()
	{
		if (Request::ajax()){
			$datos = array('programados' => Programados::orderBy('fecha_despacho','asc')->where('despachado','=',false)->paginate(10));
			return View::make('programados.nuevo',$datos);
		}
		else{
			$datos = array('programados' => Programados::orderBy('fecha_despacho','desc')->paginate(100));
			return View::make('programados.paginas',$datos);
		}
	}

	public function vertablapaginado(){

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$data = Input::all();
		$prog = new Programados;
		$prog->fecha_despacho = date('Y-m-d H:i:s',strtotime($data['fecha_despacho']));
		$prog->notas = $data['notas'];
		$prog->origen = $data['origen'];
		$prog->repite = $data['repite'];
		$prog->save();

		$log = new Logusuarios;
		$log->nuevolog($prog->id,9);

		return Redirect::to('/')->with('message', '<div class="alert alert-success" role="alert">El viaje fue programado.</div>');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{


        //reviso los programados que tienen que salir
        $config = Configuraciones::find(1);
        $progurg = DB::table('programados')
            ->where('fecha_despacho','>',db::raw('now() - interval 15 minute'))
            ->where('fecha_despacho','<',db::raw('now() + interval 15 minute'))
            ->where('despachado','=',false)
						->orwhere(function($query){
							$query->where('fecha_despacho','<',db::raw('now()'))
										->where('despachado','=',false);
						})
						->get();
				//dd($progurg);
        if ($progurg){
        	$data = array('prog' => $progurg);
       		return View::make('programados.aviso',$data);
        }
        else
        	return 0;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$prog = Programados::find($id);
		$datos = array('datos' => $prog);
		if (Request::ajax()){
			return View::make('programados.editmodal',$datos);
		}
		else
			return View::make('programados.edit',$datos);
			//return Redirect::to('/')->with('message','<div class="alert alert-danger" role="alert">Acceso denegado.</div>');

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();
		$prog = Programados::find($id);
		$prog->fecha_despacho = date('Y-m-d H:i:s',strtotime($data['fecha_despacho']));
		$prog->notas = $data['notas'];
		$prog->origen = $data['origen'];
		$prog->repite = $data['repite'];
		$prog->save();

		$log = new Logusuarios;
		$log->nuevolog($prog->id,10);

		return Redirect::to('/')->with('message','<div class="alert alert-success" role="alert">El viaje fue actualizado.</div>');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$prog = Programados::find($id);
		$prog->delete();

		$log = new Logusuarios;
		$log->nuevolog(0,13);

		return Redirect::to('/')->with('message','<div class="alert alert-success" role="alert">Se borro el viaje programado</div>');

	}


	public function ignora($id){
		$prog = Programados::find($id);
		if (!$prog->despachado){
			$prog->despachado = true;
			//$prog->deleted_at = Carbon::now();
			$prog->save();

			$log = new Logusuarios;
			$log->nuevolog($prog->id,12);

			//si tiene repeticion creo el nuevo viaje
			//repeticion por dia
			if ($prog->repite==1){
				$newprog = new Programados;
				$fecha = Carbon::createFromFormat('Y-m-d H:i:s',$prog->fecha_despacho)->addDay();
				$newprog->fecha_despacho = date('Y-m-d H:i:s',strtotime($fecha));
				$newprog->notas = $prog->notas;
				$newprog->origen = $prog->origen;
				$newprog->repite = 1;
				$newprog->save();
			}

			//repite por semana
			if ($prog->repite==2){
				$newprog = new Programados;
				$fecha = Carbon::createFromFormat('Y-m-d H:i:s',$prog->fecha_despacho)->addWeek();
				$newprog->fecha_despacho = date('Y-m-d H:i:s',strtotime($fecha));
				$newprog->notas = $prog->notas;
				$newprog->origen = $prog->origen;
				$newprog->repite = 2;
				$newprog->save();
			}

			//repite solo dias de la semana
			if ($prog->repite==3){
				$newprog = new Programados;
				$fecha = Carbon::createFromFormat('Y-m-d H:i:s',$prog->fecha_despacho)->addDay();
				while ($fecha->isWeekend()){
					$fecha->addDays(1);
				}
				$newprog->fecha_despacho = date('Y-m-d H:i:s',strtotime($fecha));
				$newprog->notas = $prog->notas;
				$newprog->origen = $prog->origen;
				$newprog->repite = 3;
				$newprog->save();
			}

			if ($prog->repite == 0){
				return Redirect::to('/')->with('message','<div class="alert alert-danger" role="alert">Se ignoró el viaje programado</div>');
			}else{
				return Redirect::to('/')->with('message','<div class="alert alert-info" role="alert">Se ignoró el viaje programado pero se respeto su repeticion</div>');
			}
		}else {
			return Redirect::to('/')->with('message','<div class="alert alert-danger" role="alert">El viaje ya fue creado por otro usuario</div>');
		}
	}

	public function progtoviaje($id){
		$prog = Programados::find($id);
		if (!$prog->despachado){

			$viaje = new  Viajes;
			$viaje->origen =  $prog->origen;
			$viaje->fecha_pedido = Carbon::now();
			$viaje->programado = true;
			$viaje->notas = $prog->notas;
			$viaje->save();

			$prog->despachado = true;
			$prog->deleted_at = Carbon::now();
			$prog->save();

			$log = new Logusuarios;
			$log->nuevolog($prog->id,11);


			//si tiene repeticion creo el nuevo viaje
			//repeticion por dia
			if ($prog->repite==1){
				$newprog = new Programados;
				$fecha = Carbon::createFromFormat('Y-m-d H:i:s',$prog->fecha_despacho)->addDay();
				$newprog->fecha_despacho = date('Y-m-d H:i:s',strtotime($fecha));
				$newprog->notas = $prog->notas;
				$newprog->origen = $prog->origen;
				$newprog->repite = 1;
				$newprog->save();
			}

			//repite por semana
			if ($prog->repite==2){
				$newprog = new Programados;
				$fecha = Carbon::createFromFormat('Y-m-d H:i:s',$prog->fecha_despacho)->addWeek();
				$newprog->fecha_despacho = date('Y-m-d H:i:s',strtotime($fecha));
				$newprog->notas = $prog->notas;
				$newprog->origen = $prog->origen;
				$newprog->repite = 2;
				$newprog->save();
			}

			//repite solo dias de la semana
			if ($prog->repite==3){
				$newprog = new Programados;
				$fecha = Carbon::createFromFormat('Y-m-d H:i:s',$prog->fecha_despacho)->addDay();
				while ($fecha->isWeekend()){
					$fecha->addDays(1);
				}
				$newprog->fecha_despacho = date('Y-m-d H:i:s',strtotime($fecha));
				$newprog->notas = $prog->notas;
				$newprog->origen = $prog->origen;
				$newprog->repite = 3;
				$newprog->save();
			}

			return Redirect::to('/')->with('message','<div class="alert alert-success" role="alert">Se creo el viaje</div>');
		}else {
			return Redirect::to('/')->with('message','<div class="alert alert-danger" role="alert">El viaje ya fue creado por otro usuario</div>');
		}
	}


}
