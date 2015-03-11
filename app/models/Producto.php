<?php

class Producto extends Eloquent {
		protected $fillable = ['name','empresas_id'];
        
         public static $rules=['name','empresas_id'];

          public function observaciones()
         {
         	return $this->belongsToMany('ObservacioneProducto');
         }

          public function empresas()
         {
         	return $this->hasoMany('Empresa');
         }
}