<?php

class Datosempresa extends Eloquent{
    
   // public static  $table= 'catalogo';
   public $table ="datos_empresas";
   public function edit($id){
       $this->set_attribute('id',$id);
   }
    
}
