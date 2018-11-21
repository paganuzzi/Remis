<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datos = array('data' => User::all());
        return View::make('user.users',$datos);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('user.nuevo');
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

            'nombreapellido'=>'required|min:6',
            'username'=>'required|unique:users,username',
            'password'=>'required|alpha_dash',
            'repassword'=> 'required|same:password',
            'email'=>'required|email|unique:users,email'
        );

        $validacion = Validator::make($datos,$reglas);

        if ($validacion->passes()){
            $usuario = new User;
            $usuario->nombreapellido = strtoupper($datos['nombreapellido']);
            $usuario->username = $datos['username'];
						$usuario->usertype = $datos['usertype'];
            $usuario->password = Hash::make(trim($datos['password']));
            $usuario->email = strtoupper($datos['email']);
            if (isset($datos['active']))
                $usuario->active = true;
            else
                $usuario->active = false;
            $usuario->save();
            return Redirect::to('user')->with('message','<div class="alert alert-success" role="alert">Usuario '.$datos['nombreapellido'].' creado</div>');
        }
        else{
            Input::flash();
            return Redirect::to('/user/create')->withErrors($validacion);
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
		$datos = array('todo' => User::all());
		return View::make('user.imprime',$datos);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$datos = array('data'=>User::find($id));
        return View::make('user.edituser',$datos);

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$datos = Input::all();
        $reglas = array(

            'nombreapellido'=>'required|min:6',
            'username'=>'required|unique:users,username,'.$id,
            'password'=>'alpha_dash',
            'repassword'=> 'same:password',
            'email'=>'required|email|unique:users,email,'.$id
        );

        $validacion = Validator::make($datos,$reglas);

        if ($validacion->passes()){
            $usuario = User::find($id);
            $usuario->nombreapellido = strtoupper($datos['nombreapellido']);
            $usuario->username = $datos['username'];
						$usuario->usertype = $datos['usertype'];
            if (!empty($datos['password']) )
                if (Hash::make(trim($datos['password']))!=($usuario->password))
                    $usuario->password = Hash::make(trim($datos['password']));
            $usuario->email = strtoupper($datos['email']);
            if (isset($datos['active']))
                $usuario->active = true;
            else
                $usuario->active = false;
            $usuario->save();
            return Redirect::to('/user')->with('message','<div class="alert alert-success" role="alert">Usuario '.$datos['nombreapellido'].' actualizado</div>');
        }
        else{
            Input::flash();
            return Redirect::to('/user/'.$id.'/edit')->withErrors($validacion);
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
