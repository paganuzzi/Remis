<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LogusuariosDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logusuarios',function($table){
			$table->increments('id');
			$table->integer('id_users');
			$table->enum('accion',['creaviaje','asignamovil','asignadire','terminaviaje','creamovil','pausamovil','activamovil','cierramovil','creaprogramado','editaprogramado','asignaprogramado','ignoraprogramado','borraprogramado','ingresa','sale','borraviaje','reasignamovil']);
			$table->integer('id_accion');
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
