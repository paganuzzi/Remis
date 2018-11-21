<?php
	class Viajes extends Eloquent{

	protected $table = 'viajes';


	public function Mobiles(){
		return $this->belongsTo('Mobiles');
	}

	public function scopeMaxtiempoviaje($query){
		$espera = $query->select(DB::raw('minute(timediff(`updated_at` , `fecha_pedido`)) as tiempoviaje'))
								 ->where('terminado','=',1)
								 ->where(DB::raw('timediff(`updated_at` , `fecha_pedido`)'),'<',Configuraciones::find(1)->tiempomaxviaje)
								 ->orderBy('id','desc')
								 ->take(5)
								 ->get();
		return $espera;
	}

	public function scopeTodoviajes($query,$fecha){
		if ($fecha['fecha'] != ""){
			$fech = date("Y-m-d",strtotime($fecha['fecha']));
			return $query->where(DB::raw('date(created_at)'),'=',DB::raw('date("'.$fech.'")'))->orderBy('updated_at','desc')->get();
		}else{
			return $query->orderBy('updated_at','desc')->get();
		}
	}
}
