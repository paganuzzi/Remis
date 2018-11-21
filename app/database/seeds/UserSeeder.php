<?php

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
					 'username' => 'demo',
					 'nombreapellido' => 'Usuario Demo',
					 'email' => 'demo@demo.com',
					 'password' => Hash::make('demo'),
					 'usertype'=>'0',
					 'active'=>'1'
			 ]);
	}

}
