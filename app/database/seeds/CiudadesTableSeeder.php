<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class CiudadesTableSeeder extends Seeder {

    public function run() {
        Ciudade::create([
            'id'=>1,
            'name'=>'ATLANTIDA'
        ]);
        Ciudade::create([
            'id'=>2,
            'name'=>'COPAN'
        ]);
        Ciudade::create([
            'id'=>3,
            'name'=>'CORTES'
        ]);
        Ciudade::create([
            'id'=>4,
            'name'=>'COLON'
        ]);
        Ciudade::create([
            'id'=>5,
            'name'=>'COMAYAGUA'
        ]);
        Ciudade::create([
            'id'=>6,
            'name'=>'CHOLUTECA'
        ]);
        Ciudade::create([
            'id'=>7,
            'name'=>'EL PARAISO'
        ]);
        Ciudade::create([
            'id'=>8,
            'name'=>'INTIBUCA'
        ]);
        Ciudade::create([
            'id'=>9,
            'name'=>'GRACIAS A DIOS'
        ]);
        Ciudade::create([
            'id'=>10,
            'name'=>'FRANCISCO MORAZAN'
        ]);
        Ciudade::create([
            'id'=>11,
            'name'=>'LEMPIRA'
        ]);
        Ciudade::create([
            'id'=>12,
            'name'=>'LA PAZ'
        ]);
        Ciudade::create([
            'id'=>13,
            'name'=>'OLANCHO'
        ]);
        Ciudade::create([
            'id'=>14,
            'name'=>'OCOTEPEQUE'
        ]);
        Ciudade::create([
            'id'=>15,
            'name'=>'SANTA BARBARA'
        ]);
        Ciudade::create([
            'id'=>16,
            'name'=>'ISLAS DE LA BAHIA'
        ]);
        Ciudade::create([
            'id'=>17,
            'name'=>'VALLE'
        ]);
        Ciudade::create([
            'id'=>18,
            'name'=>'YORO'
        ]);
    }

}
