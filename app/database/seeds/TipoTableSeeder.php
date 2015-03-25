<?php

class TipoTableSeeder extends Seeder {

    public function run() {

        Tipo::create([
            'id' => 1,
            'name' => 'Administrador'
        ]);
        Tipo::create([
            'id' => 2,
            'name' => 'Editores'
        ]);
        Tipo::create([
            'id' => 3,
            'name' => 'Claro'
        ]);
    }

}
