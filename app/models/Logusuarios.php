<?php
class Logusuarios extends Eloquent{

	protected $table='logusuarios';


	/*tipos de eventos
	1: crea viaje
	2: asigan movil
	3: asigna direccion
	4: termina viaje
	5: crea movil
	6: pausa movil
	7: activa movil
	8: cierra movil
	9: crea programado
	10: edita programado
	11: asigna programado
	12: ignora programado
	13: borra programado
	14: ingresa al sistema
	15: sale del sistema
	16: Borra viaje
	17: reasigna mobil
	*/
	public function nuevolog($id,$tipo){
			$this->accion = $tipo;
			$this->id_accion = $id;
			$this->id_users = Auth::user()->id;
			$this->save();
	}
}
