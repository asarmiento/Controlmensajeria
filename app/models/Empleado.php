<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Empleado extends Eloquent{
    	protected $fillable = [];
        
         public static $rules=[];
         
         public function Ciudades()
         {
             return $this->hasMany('Ciudade');
         }

         
}

