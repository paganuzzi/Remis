<?php

class MobilController extends \BaseController {

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

		$coche = DB::table('coches')
			->where('asignado','=',false)
			->where('estado','=',true)
			->lists(DB::raw('concat("Modelo: ",modelo," / Marca: ",marca," / Patente: ",patente)'),'id');

		$chofer = DB::table('choferes')
			->where('asignado','=',false)
			->where('estado','=',true)
			->lists('nombre','id');

    $data = array('coche'=>$coche,'choferes'=>$chofer);
		return View::make('remis.newmobil',$data);

	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$datos = Input::all();

		$reglas = array(

			'nombre'=>'unique:mobiles,numerocoche,null,id,liquidado,0'
		);

		$validacion = Validator::make($datos,$reglas);

		if ($validacion->passes()){

			$mobil = new Mobiles;
			$mobil->coches_id = $datos['idcoche'];
			$mobil->choferes_id = $datos['idchofer'];
			$mobil->habilitado = true;
			$mobil->estado = 'libre';
			$mobil->numerocoche = $datos['nombre'];
			$mobil->liquidado = false;
			$mobil->save();

			$log = new Logusuarios;
			$log->nuevolog($mobil->id,5);

			$coche = Coches::find($datos['idcoche']);
			$coche->asignado = true;
			$coche->save();

			$chofer = Choferes::find($datos['idchofer']);
			$chofer->asignado = true;
			$chofer->save();

			return Redirect::to('/')->with('message','<div class="alert alert-success" role="alert">Se creo el movil '.$datos['nombre'].'</div>');;

		}else{
			return Redirect::to('/')->with('message','<div class="alert alert-danger" role="alert">'.$datos['nombre'].' que trato de crear ya existe</div>');
		}
	}

	//cierra un movil
	public function cierramovil($id){

		//atencion tengo que validar que no este en viaje antes de cerrarlo

		$movil = Mobiles::find($id);
		if ($movil->estado=='libre' or $movil->estado=='pausado'){
			$movil->deleted_at = Carbon::now();
			$movil->liquidado = true;
			$movil->habilitado = false;
			$movil->save();

			$log = new Logusuarios;
			$log->nuevolog($movil->id,8);

			$chofer = Choferes::find($movil->choferes_id);
			$chofer->asignado = false;
			$chofer->save();

			$coche = Coches::find($movil->coches_id);
			$coche->asignado = false;
			$coche->save();

			return Redirect::to ('/planilla')->with(array('imprime_ticket'=>'planilla/imprime/ticket/'.$id,'message'=>'<div class="alert alert-success" role="alert">Se cerro el movil '.$movil->numerocoche.' se libero el chofer '.$chofer->nombre.' y el coche '.$coche->marca.' '.$coche->modelo.' patente '.$coche->patente.'</div>'));
		}
		else
		{
			return Redirect::to ('/')->with('message','<div class="alert alert-danger" role="alert">El movil '.$movil->numerocoche.' no se encuentra libre debe terminar el viaje asignado.</div>');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	//devuelve mobiles libres
    public function mobiles_libres(){

        if (Request::ajax()){
            $mobiles = DB::table('mobiles')
                        ->where('habilitado','=',true)
                        ->where('estado','=','libre')
                        ->where('id','<>',0)
                        ->where('liquidado','=',false)
												->orderBy('updated_at','asc')
                        ->lists('numerocoche','id');
            $data = array('mobiles'=>$mobiles);
            return View::make('mobileslibres',$data);
        }else
        {
            return Redirect::to('/');
        }
    }


		//devuelve moviles libres para reasignacion
		public function mobiles_libres_reasigna(){
				if (Request::ajax()){
						$mobiles = DB::table('mobiles')
												->where('habilitado','=',true)
												->where('estado','=','libre')
												//->where('id','<>',0)
												->where('liquidado','=',false)
												->orderBy('id','desc')
												->lists('numerocoche','id');
						$data = array('mobiles'=>$mobiles);
						return View::make('mobileslibres_reasign',$data);
				}else
				{
						return Redirect::to('/');
				}
		}



    //lista de moviles para ser pausados
    public function pausamobil(){
        if (Request::ajax()){
            $mobiles = DB::table('mobiles')
                        ->where('habilitado','=',true)
                        ->where('estado','=','libre')
                        ->where('id','<>',0)
                        ->where('liquidado','=',false)
												->orwhere(function($query){
													$query->where('estado','=','pausado')
                        				->where('liquidado','=',false);
												})
                        ->lists(DB::raw('concat("Numero Movil: ",numerocoche," / Estado: ",estado)'),'id');
            $data = array('mobiles'=>$mobiles);
            return View::make('remis.pausamobil',$data);
        }else
        {
            return Redirect::to('/');
        }
    }

    //pausa un movil o lo reactiva
    public function estadomovil(){
            $id = Input::all();
            $movil = Mobiles::find($id['movilpausa']);

            if (isset($id['cierra']))
            	return $this->cierramovil($id['movilpausa']);
						else
						{
	            if ($movil->estado == 'libre'){
	                $estado = 'pausado';

					        $log = new Logusuarios;
					        $log->nuevolog($movil->id,6);

	            }else
	            {
	                $estado = 'libre';

					        $log = new Logusuarios;
					        $log->nuevolog($movil->id,7);

	            }
	            $movil->estado = $estado;
	            $movil->save();

	            //meto un log pa seguir lo que pasa
	            $log = new Logmoviles;
	            $log->mobil_id = $id['movilpausa'];
	            $log->detalle = $id['detalle'];
            	$log->gastos = $id['gastos'];
							$log->estado = $estado;
	            $log->save();

	            return Redirect::to('/')->with('message','<div class="alert alert-success" role="alert">El movil '.$movil->numerocoche.' esta '.$estado.'</div>');
            }
    }


}
