<?php

class EstadisticasController extends \BaseController {

public function index(){
	  $query = DB::table('viajes')
								->leftjoin('mobiles','mobiles.id','=','viajes.mobiles_id')
								->select(db::raw('sum(viajes.monto) as suma_viajes'),'numerocoche','coches_id','choferes_id','mobiles.id',db::raw('count(viajes.id) as cantidad'))
								->where('mobiles.id','<>',0)
								->where('terminado','=',true)
								->where('adeuda','=',false)
								->where(db::raw('month(curdate())'),'=',db::raw('month(viajes.updated_at)'))
								->where(db::raw('year(curdate())'),'=',db::raw('year(viajes.updated_at)'))
								->groupby('numerocoche','choferes_id')
								->orderby('suma_viajes','desc')
								//->get();
								->paginate(15);
		//si no hay resultado mando false a la vista y no aparece la tabla
		if (!$query){
			$query = false;
		}
		$grafico = DB::table('viajes')
								->select(db::raw('sum(monto) as suma_viajes'),db::raw('month(updated_at) as mes_viaje'))
								->groupby(db::raw('month(updated_at)'))
								->get();
		//dd($grafico);
		$meses = array('1' => 'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto'
					,'9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');

    $config = Configuraciones::find(1);

		$adeudados = Viajes::where('adeuda','=',true)->get();
		//si no hay adeudados mando false
		if(!$adeudados){
			$adeudados = false;
		}

		$logmoviles = DB::table('logmoviles')
								->select(db::raw('sum(gastos) as monto'),'mobil_id')
								->groupBy('mobil_id')
								->paginate(10);

		$usuarios = User::all();

		$data = array('usuarios'=>$usuarios,'datos'=>$query,'config'=>$config,'grafico'=>$grafico,'meses'=>$meses,'adeudados'=>$adeudados,'logmoviles'=>$logmoviles);

    return View::make('admin.estadisticas',$data);


}


public function show($id){
	$data = DB::table('logusuarios')
										->where('id_users','=',$id)
										->orderBy('created_at','desc')
										->paginate(50);
	if ($data->count()>0){
		$data = array('data' => $data);
		return View::make('admin.movimientos',$data);
	}else{
		return Redirect::back()->with('message','<div class="alert alert-info">Sin datos del usuario</div>');
	}
}

public function detallelog($id){
	if (Request::ajax()){
		$logmoviles = DB::table('logmoviles')
								->select('gastos','mobil_id','detalle','estado','created_at')
								->where('mobil_id','=',$id)
								->get();
		return View::make('admin.detallelog',['logmoviles'=>$logmoviles]);
	}else{
		return Redirect::to('/');
	}
}


}
