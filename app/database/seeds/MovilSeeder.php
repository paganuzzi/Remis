<?php

class MovilSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('mobiles')->insert([
					 'id' => 0,
					 'coches_id' => 0,
					 'choferes_id' => 0,
					 'habilitado' => true,
					 'estado' => 'libre',
					 'numerocoche' => 'Sin Asignar',
					 'liquidado'=>0,
					 'created_at'=>'null',
					 'updated_at'=>'null',
					 'deleted_at'=>'null'
			 ]);

		DB::table('mobiles')->update([
			'id'=>0
			]);
	}

}
