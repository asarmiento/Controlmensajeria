<?php

class Historial extends Eloquent {
		protected $fillable = ['mes','year','url','productos_id'];
        
         public static $rules=['mes'=>'requiere','year'=>'requiere','url'=>'requiere','productos_id'=>'requiere'];

         public function productos()
         {
         	return $this->belongsTo('Producto');
         }

         public function datosEmpresas()
         {
         	return $this->hasMany('DatosEmpresa','historials_id','id');
         }
        
}