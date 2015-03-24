<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class EmpresasTableSeeder extends Seeder {

	public function run()
	{
		Empresa::create([
                    'id'=>1,
                    'name'=>'Claro',
                    'logo'=>'claro/logo.png'
			]);
		
	}

}