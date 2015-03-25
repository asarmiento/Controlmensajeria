<?php

class DatosEmpresa extends \Eloquent {
   
	protected $fillable = [];
        
         public static $rules=[];

         public function observaciones(){

         	return $this->belongsTo('Observacione');
         }
        public function observacionesMany(){

         	return $this->belongsToMany('Observacione');
         }
         public function ciudades(){

         	return $this->belongsTo('Ciudade');
         }

         public function empleados(){

         	return $this->belongsTo('Empleado');
         }
}