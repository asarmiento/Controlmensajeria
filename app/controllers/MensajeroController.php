<?php

class MensajeroController extends BaseController {

    public function getIndex() {
        $paginado = Empleado::paginate(15);

        return View::make('mensajeros.index', array('resultado' => $paginado));
    }

    public function postCreate() {
        
        $Empleado = new Empleado;
        $Empleado->save(Input::all());
        $paginado = Empleado::paginate(15);

        return View::make('mensajeros.index', array('resultado' => $paginado)); 
    }

}
