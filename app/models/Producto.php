<?php

class Producto extends Eloquent {
		protected $fillable = ['name','empresas_id'];
        
         public static $rules=['name','empresas_id'];
}