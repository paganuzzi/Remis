<?php
class Coches extends Eloquent{
	protected $table = 'coches';

	public function Mobiles(){
		return $this->hasMany('Mobiles');
	}

	public function scopeVencimientos($query){
		return $query->where('estado','=',true)
								 ->where(DB::raw('datediff(vencimiento,now())'),'<',Configuraciones::find(1)->avisovenceseguro)
								 ->orWhere(DB::raw('datediff(vencehabilitacion,now())'),'<',Configuraciones::find(1)->avisovenceseguro);
	}
}
