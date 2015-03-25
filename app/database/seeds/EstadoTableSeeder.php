<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class EstadoTableSeeder extends Seeder {

    public function run() {

        Estado::create([
            'id'=>1,
            'name'=>'En Ruta'
        ]);
        Estado::create([
            'id'=>2,
            'name'=>'Entregado'
        ]);
        Estado::create([
            'id'=>3,
            'name'=>'Devolucion'
        ]);Estado::create([
            'id'=>4,
            'name'=>'No Entregado'
        ]);
        
    }

}
