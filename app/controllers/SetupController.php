<?php

class SetupController extends BaseController {
    
    public function getIndex(){
          $conn = DB::connection("diurno");
          $paginacion = $conn->table("informacion")->get();
        return View::make('setup.index',array('resultado'=>$paginacion));
    }
    public function getLigar(){
       return View::make('setup.estadobservacion'); 
    }
        public function postLigar(){
       return View::make('setup.estadobservacion'); 
    }
}