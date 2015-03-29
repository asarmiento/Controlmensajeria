<?php

class Empresa extends Eloquent {
		protected $fillable = ['name','logo'];
        
         public static $rules=['name','logo'];
         
         public function productos(){
             
             return $this->hasMany('Producto','empresas_id','id');
         }
}