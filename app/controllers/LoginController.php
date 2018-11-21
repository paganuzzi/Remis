<?php

class LoginController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
            if (Auth::check()) {
            return Redirect::to('admin');
        } else {
            return View::make('admin.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $datos = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'active'=> true,
        );
        //si esta marcado recuerda

        if (Input::get('recuerda')){
            $login = Auth::attempt($datos,true);
        }else{
            $login = Auth::attempt($datos);
        }

        if ($login) {
            $log = new Logusuarios;
            $log->nuevolog(0,14);

            return Redirect::intended('admin');

        } else {
            Input::flash();
            return Redirect::to('login')->with('message','<div class="alert alert-danger" role="alert">Login Incorrecto</div>');
            }

        }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy() {
    }

}
