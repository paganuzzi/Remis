<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CochesDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coches',function($table){
			$table->increments('id');
			$table->string('marca');
			$table->string('modelo');
			$table->string('patente');
			$table->string('aseguradora');
			$table->date('vencimiento');
			$table->string('numhabilitacion');
			$table->date('vencehabilitacion');
			$table->boolean('estado');
			$table->boolean('asignado');
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
