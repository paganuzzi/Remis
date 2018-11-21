<?php

class ChoferesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datos = DB::table('choferes')->select('*',DB::raw('datediff(vencimiento,now()) as diasvencimiento'))->get();
		$data = array ('data'=>$datos,'config'=>Configuraciones::find(1));
		return View::make('choferes.choferes',$data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('choferes.nuevo');
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
            'nombre' => 'required|min:3',
            'dni'=>'required|min:8|max:10|unique:choferes',
            'fechanac' => 'date_format:d-m-Y',
            'telefono' => 'required|unique:choferes',
            'direccion' => 'required',
            'numlicencia'=> 'required',
            'otorgamiento'=>'required|date|date_format:d-m-Y',
            'vencimiento'=>'required|date|date_format:d-m-Y',
            'clases'=>'required',
            'grupofactor'=>'required'

        );

        $validate = Validator::make($datos, $reglas);

        if ($validate->passes()){

			$chofer = new Choferes;
			$chofer->nombre = strtoupper($datos['nombre']);
			$chofer->dni = $datos['dni'];
			$chofer->fechanac = date('Y-m-d',strtotime($datos['fechanac']));
			$chofer->telefono = $datos['telefono'];
			$chofer->direccion = strtoupper($datos['direccion']);
			$chofer->numlicencia = $datos['numlicencia'];
			$chofer->otorgamiento = date('Y-m-d',strtotime($datos['otorgamiento']));
			$chofer->vencimiento = date('Y-m-d',strtotime($datos['vencimiento']));
			$chofer->clases = strtoupper($datos['clases']);
			$chofer->grupofactor = strtoupper($datos['grupofactor']);
			$chofer->restricciones = strtoupper($datos['restricciones']);
			if (isset($datos['estado']))
				$chofer->estado = true;
			else
				$chofer->estado = false;
			$chofer->asignado = false;
			$chofer->save();
			return Redirect::to('/choferes')->with('message','<div class="alert alert-success" role="alert">Chofer '.$datos['nombre'].' creado</div>');
		}
		else
		{
			Input::flash();
			return View::make('choferes.nuevo')->withErrors($validate);
		}

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 //lo uso para imprimir
	public function show($id)
	{
		$datos = array('todo' => Choferes::all());
		return View::make('choferes.imprime',$datos);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('data' => Choferes::find($id) );
		return View::make('choferes.edit',$data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//date_format:d-m-Y

		$datos = Input::all();

		$reglas = array(
            'nombre' => 'required|min:3',
            'dni'=>'required|min:8|max:10|unique:choferes,dni,'.$id,
            'fechanac' => 'date_format:d-m-Y',
            'telefono' => 'required|unique:choferes,telefono,'.$id,
            'direccion' => 'required',
            'numlicencia'=> 'required',
            'otorgamiento'=>'required|date|date_format:d-m-Y',
            'vencimiento'=>'required|date|date_format:d-m-Y',
            'clases'=>'required',
            'grupofactor'=>'required'

        );

        $validate = Validator::make($datos, $reglas);

        if ($validate->passes()){

			$chofer = Choferes::find($id);
			$chofer->nombre = strtoupper($datos['nombre']);
			$chofer->dni = $datos['dni'];
			$chofer->fechanac = date('Y-m-d',strtotime($datos['fechanac']));
			$chofer->telefono = $datos['telefono'];
			$chofer->direccion = strtoupper($datos['direccion']);
			$chofer->numlicencia = $datos['numlicencia'];
			$chofer->otorgamiento = date('Y-m-d',strtotime($datos['otorgamiento']));
			$chofer->vencimiento = date('Y-m-d',strtotime($datos['vencimiento']));
			$chofer->clases = strtoupper($datos['clases']);
			$chofer->grupofactor = strtoupper($datos['grupofactor']);
			$chofer->restricciones = strtoupper($datos['restricciones']);
			if (isset($datos['estado']) || $chofer->asignado)
				$chofer->estado = true;
			else
				$chofer->estado = false;
			$chofer->save();
			return Redirect::to('/choferes')->with('message','<div class="alert alert-success" role="alert">Chofer '.$datos['nombre'].' actualizado</div>');;
		}
		else
		{
			Input::flash();
			return Redirect::to('/choferes/'.$id.'/edit')->withErrors($validate);
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
