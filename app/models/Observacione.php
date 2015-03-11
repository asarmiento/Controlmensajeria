<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Observacion
 *
 * @author Sistemas Amigables
 */
class Observacione extends \Eloquent {
   	protected $fillable = [];
        
         public static $rules=[];

         public function estados(){

         	return $this->belongsTo('Estado');
         }

         public function datosEmpresas(){

         	return hasMany('DatosEmpresa');
         }
         public function productos(){

         	return $this->belongsToMany('Producto');
         }
}
