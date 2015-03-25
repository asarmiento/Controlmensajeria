<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
                
//                $this->call('EstadoTableSeeder');
 //               $this->call('ObservacionesTableSeeder');
//                $this->call('CiudadesTableSeeder');
//                $this->call('EmpresasTableSeeder');
//                $this->call('ProductosTableSeeder');
//                $this->call('TypeUsersTableSeeder');
	 $this->call('UserTableSeeder');
	}

}
