<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MobilesDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mobiles',function($table){
			$table->increments('id');
			$table->integer('coches_id');
			$table->integer('choferes_id');
			$table->boolean('habilitado');
			$table->enum('estado',['libre','ocupado','pausado']);
			$table->string('numerocoche');
			$table->boolean('liquidado');
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
