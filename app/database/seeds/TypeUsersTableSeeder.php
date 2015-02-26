<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TypeUsersTableSeeder extends Seeder {

	public function run()
	{
		
			TypeUser::create([
                            'name'=>'Super Administrador'
			]);
                        TypeUser::create([
                            'name'=>'Administrador'
			]);
                        TypeUser::create([
                            'name'=>'Editores'
			]);
                        TypeUser::create([
                            'name'=>'Clientes'
			]);
                        
	}

}