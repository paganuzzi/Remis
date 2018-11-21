<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChoferesDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('choferes',function($table){
			$table->increments('id');
			$table->string('nombre');
			$table->string('dni');
			$table->date('fechanac');
			$table->string('foto');
			$table->string('telefono');
			$table->string('direccion');
			$table->string('numlicencia');
			$table->date('otorgamiento');
			$table->date('vencimiento');
			$table->string('clases');
			$table->string('grupofactor');
			$table->text('restricciones');
			$table->boolean('estado');
			$table->boolean('asignado');
			$table->softdeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
