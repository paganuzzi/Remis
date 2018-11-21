<?php
class Logmoviles extends Eloquent{

	protected $table='logmoviles';


	public function scopeSumagastos($query,$id){
		return $query->select(DB::raw('sum(gastos) as gastos'))->where('mobil_id','=',$id)->get();
	}
}
