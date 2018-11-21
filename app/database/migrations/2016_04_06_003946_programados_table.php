<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProgramadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('programados',function($table){
			$table->increments('id');
			$table->string('origen');
			$table->datetime('fecha_despacho');
			$table->boolean('despachado');
			$table->text('notas');
			$table->enum('repite',['null','1','2','3']);
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
