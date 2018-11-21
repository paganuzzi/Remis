<?php

Class Mobiles extends Eloquent{

	protected $table = 'mobiles';

	public function coches(){
		return $this->belongsTo('coches');
	}

	public function choferes(){
		return $this->belongsTo('choferes');
	}

	public function Viajes(){
		return $this->hasMany('Viajes');
	}

	public function logmoviles(){
		return $this->hasMany('logmoviles');
	}


	public function scopeMovileslibres($query){
		return $query->where('estado','=','libre')->where('habilitado','=',1)->where('liquidado','=',0)->where('id','!=',0)->get();
	}

	public function scopeProximoquesale($query){
		return $query->where('habilitado','=',true)->select('numerocoche')->where('liquidado','=',false)->where('estado','=','libre')->where('id','!=',0)->orderBy('updated_at','asc')->get();
	}

}
?>
