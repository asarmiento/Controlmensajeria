<?php

class Empresa extends Eloquent {
		protected $fillable = ['name','logo'];
        
         public static $rules=['name','logo'];
         
         public function Productos(){
             
             return $this->hasMany('Producto','empresas_id','id');
         }
}