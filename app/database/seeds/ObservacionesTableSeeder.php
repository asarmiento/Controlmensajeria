<?php

class ObservacionesTableSeeder extends Seeder {

    public function run() {

        Observacione::create([
            'id' => 1,
            'name' => 'Bajo puerta',
            'estados_id' => 2
        ]);
        Observacione::create([
            'id' => 2,
            'name' => 'Porch',
            'estados_id' => 2
        ]);
        Observacione::create([
            'id' => 3,
            'name' => 'Buzón',
            'estados_id' => 2
        ]);
        Observacione::create([
            'id' => 4,
            'name' => 'Recibido por el titular',
            'estados_id' => 2
        ]);
        Observacione::create([
            'id' => 5,
            'name' => 'Recibido por familiar',
            'estados_id' => 2
        ]);
        Observacione::create([
            'id' => 6,
            'name' => 'Recibido por comprañero de  trabajo',
            'estados_id' => 2
        ]);
        Observacione::create([
            'id' => 7,
            'name' => 'Mala Dirección',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 8,
            'name' => 'Dirección incompleta',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 9,
            'name' => 'Cambio de dirección',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 10,
            'name' => 'Cambio de centro de trabajo',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 11,
            'name' => 'Desconocido en dirección',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 12,
            'name' => 'Está de vacaciones',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 13,
            'name' => 'Dirección en zona de alto riesgo',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 14,
            'name' => 'Dirección en blanco',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 15,
            'name' => 'Rechazada por el cliente',
            'estados_id' => 3
        ]);
        Observacione::create([
            'id' => 16,
            'name' => 'No se Recibió',
            'estados_id' => 4
        ]);
    }

}
