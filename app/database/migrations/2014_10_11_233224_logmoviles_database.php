<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogmovilesDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logmoviles',function($table){
			$table->increments('id');
			$table->integer('mobil_id');
			$table->text('detalle');
			$table->enum('estado',['libre','pausado']);
			$table->double('gastos');
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
