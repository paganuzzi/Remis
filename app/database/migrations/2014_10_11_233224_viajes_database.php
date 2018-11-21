<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViajesDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('viajes',function($table){
			$table->increments('id');
			$table->integer('mobiles_id');
			$table->string('origen');
			$table->string('destino');
			$table->double('monto');
			$table->text('notas');
			$table->boolean('terminado');
			$table->boolean('programado');
			$table->boolean('adeuda');
			$table->timestamp('fecha_pedido');
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
