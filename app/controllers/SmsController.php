<?php

class SmsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Request::ajax()){
				$sms = Sms::where('para','=',Auth::user()->id)->orderBy('created_at','desc')->paginate(12);
				$datos = array('sms'=>$sms);
				return	View::make('sms.formnew',$datos);
		}else{
			return Redirect::to('/');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$sms = new Sms;
		$sms->desde = Auth::user()->id;
		$sms->para = $input['destino'];
		$sms->sms = $input['sms'];
		$sms->save();
		return Redirect::back();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Request::ajax()){
				$sms = Sms::find($id);
				$sms->leido = true;
				$sms->save();
				$todos = Sms::where('para','=',Auth::user()->id)->orderBy('leido','asc')->paginate(12);
				$data = Sms::where('para','=',Auth::user()->id)->where('id','=',$id)->get();
				$data = array('data' =>$data,'sms'=>$todos);
				return View::make('sms.formresp',$data);
		}else{
			return Redirect::to('/');
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$anterior = Sms::find($id);
		$input = Input::all();
		$sms = new Sms;
		$sms->desde = Auth::user()->id;
		$sms->para = $input['destino'];
		$sms->sms = $anterior->sms."<br />".$input['sms'];
		$sms->save();
		return Redirect::back();
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
