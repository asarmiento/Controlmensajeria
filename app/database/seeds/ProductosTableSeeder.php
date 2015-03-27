<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class ProductosTableSeeder extends Seeder {

	public function run()
	{
		Producto::create([
                    'id'=>1,
                    'name'=>'Ciclo C-46 TV',
                    'empresas_id'=>1
			]);
                Producto::create([
                    'id'=>2,
                    'name'=>'Ciclo C-46 Movil',
                    'empresas_id'=>1
			]);
                Producto::create([
                    'id'=>3,
                    'name'=>'Ciclo C-48',
                    'empresas_id'=>1
			]);
		
	}

}