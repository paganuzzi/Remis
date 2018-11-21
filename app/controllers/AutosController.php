<?php

class AutosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $config = Configuraciones::find(1);

        $autos = DB::table('coches')->select('*',DB::raw('datediff(vencimiento,now()) as diasvencimiento'),DB::raw('datediff(vencehabilitacion,now()) as vencehabilita'))->get();
        $data = array('config'=>$config,'data'=>$autos);
        return View::make('autos.autos',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('autos.nuevo');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//date_format:d-m-Y

		$datos = Input::all();

		$reglas = array(
            'marca' => 'required|min:3',
            'modelo' => 'required',
            'patente' => 'required|unique:coches',
            'aseguradora' => 'required',
            'vencimiento'=> 'required|date_format:d-m-Y',
            'numhabilitacion' => 'required',
            'vencehabilitacion' => 'required|date_format:d-m-Y'
        );

        $validate = Validator::make($datos, $reglas);

        if ($validate->passes()){

			$auto = new Coches;
			$auto->marca = strtoupper($datos['marca']);
			$auto->modelo = strtoupper($datos['modelo']);
			$auto->patente = strtoupper($datos['patente']);
			$auto->aseguradora = strtoupper($datos['aseguradora']);
			$auto->vencimiento = date('Y-m-d',strtotime($datos['vencimiento']));
			$auto->numhabilitacion = strtoupper($datos['numhabilitacion']);
			$auto->vencehabilitacion = date('Y-m-d',strtotime($datos['vencehabilitacion']));
			if (isset($datos['estado']))
				$auto->estado = true;
			else
				$auto->estado = false;
			$auto->asignado = false;
			$auto->save();
			return Redirect::to('/autos')->with('message','<div class="alert alert-success" role="alert">Auto marca '.$datos['marca'].' y modelo '.$datos['modelo'].' creado</div>');;
		}
		else
		{
			Input::flash();
			return View::make('autos.nuevo')->withErrors($validate);
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
		$datos = array('todo' => Coches::all());
		return View::make('autos.imprime',$datos);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$coche = Coches::find($id);
		$data = array('data'=>$coche);
		return View::make('autos.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$coche = Coches::find($id);
		$datos = Input::all();

		$reglas = array(
            'marca' => 'required|min:3',
            'modelo' => 'required',
            'patente' => 'required|unique:coches,patente,'.$id,
            'aseguradora' => 'required',
            'vencimiento'=> 'required|date_format:d-m-Y',
            'numhabilitacion' => 'required',
            'vencehabilitacion' => 'required|date_format:d-m-Y'
        );

        $validate = Validator::make($datos, $reglas);

        if ($validate->passes()){
        		$coche->marca = strtoupper($datos['marca']);
        		$coche->modelo = strtoupper($datos['modelo']);
        		$coche->patente = strtoupper(trim($datos['patente']));
        		$coche->aseguradora = strtoupper($datos['aseguradora']);
        		$coche->vencimiento = date('Y-m-d',strtotime($datos['vencimiento']));
        		$coche->numhabilitacion = strtoupper($datos['numhabilitacion']);
				$coche->vencehabilitacion = date('Y-m-d',strtotime($datos['vencehabilitacion']));

	        	if (isset($datos['estado']) || $coche->asignado){
	        		$coche->estado = true;
	        	}else{
	        		$coche->estado = false;
	        	}
        		$coche->save();
        		return Redirect::to('/autos')->with('message', '<div class="alert alert-success" role="alert">Auto marca '.$datos['marca'].' y modelo '.$datos['modelo'].' editado</div>');
        	}else
        	{
        		Input::flash();
        		return Redirect::to('/autos/'.$id.'/edit')->withErrors($validate);
        	}
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


}
