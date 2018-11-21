<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfiguracionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configuraciones',function($table){
			$table->increments('id');
			$table->string('nombreremis');
			$table->text('notas');
			$table->double('porcentaje_remisera');
			$table->time('tiempomaxviaje');
			$table->integer('avisovenceseguro');
			$table->integer('avisovencechofer');
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
