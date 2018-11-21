<?php
class Choferes extends Eloquent{

	protected $table='choferes';

	public function Mobiles(){
		return $this->hasMany('Mobiles');
	}

	public function scopeVencimientos($query){
		return $query->where('estado','=',true)
								 ->where(DB::raw('datediff(vencimiento,now())'),'<',Configuraciones::find(1)->avisovenceseguro);
	}

	public function scopeCumple($query){
		return $query->where(DB::raw('day(fechanac)'),'=',DB::raw('day(NOW())'))->where(DB::raw('month(fechanac)'),'=',DB::raw('month(NOW())'));
	}
}
