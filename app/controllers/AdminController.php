<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $config = Configuraciones::find(1);
        $data = array('config'=>$config);
        return View::make('admin.principal',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */





	public function create()
	{
		//
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

            'porcentaje'=>'required|between:1,100|numeric',
						'nombreremis'=>'required',
            //'tiempomaxviaje'=>'required|date|date_format:h:m:s',
            'avisovenceseguro'=>'required|numeric',
            'avisovencechofer'=> 'required|numeric',
        );

        $validacion = Validator::make($datos,$reglas);

        if ($validacion->passes()){

			$config = Configuraciones::find(1);
			$config->porcentaje_remisera = $datos['porcentaje'];
			$config->nombreremis = $datos['nombreremis'];
			$config->notas = $datos['notas'];
			$config->tiempomaxviaje = $datos['tiempomaxviaje'];
			$config->avisovenceseguro = $datos['avisovenceseguro'];
			$config->avisovencechofer = $datos['avisovencechofer'];
			$config->save();
			return Redirect::to('admin')->with('message','<div class="alert alert-success" role="alert">Datos Guardados</div>');
			}
		else{
			Input::flash();
			return Redirect::to('admin')->withErrors($validacion);
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
		//lo uso para mostrar mensages depende el id es el tipo de mensage
		//id = 1 vencimientos
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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


}
