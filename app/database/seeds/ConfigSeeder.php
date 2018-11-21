<?php

class ConfigSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('configuraciones')->insert([
					 'nombreremis' => 'Demo',
					 'porcentaje_remisera' => 30,
			 ]);
	}

}
