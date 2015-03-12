<?php

class Producto extends Eloquent {
		protected $fillable = ['name','empresas_id'];
        
         public static $rules=['name','empresas_id'];

          public function observaciones()
         {
         	return $this->belongsToMany('Observacione');
         }

          public function empresas()
         {
         	return $this->hasoMany('Empresa');
         }
         
         public function historials(){
             return $this->belongsTo('Historial');
         }
}