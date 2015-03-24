<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Empleado extends Eloquent{
    	protected $fillable = ['fname','sname','flast','slast','celular','cedula','ciudades_id'];
        
         public static $rules=['fname'=>'required','sname'=>'required','flast'=>'required','slast'=>'required','celular'=>'required','cedula'=>'required','ciudades_id'=>'required'];
         
         public function Ciudades()
         {
             return $this->hasMany('Ciudade');
         }

         public function isValid($data) {
        $rules = ['cedula' => 'required|unique:empleados',
        'fname'=>'required',
        'sname'=>'required',
        'flast'=>'required',
        'slast'=>'required',
        'celular'=>'required',
        'ciudades_id'=>'required'];

        if ($this->exists) {
            $rules['cedula'] .= ',cedula,' . $this->id;
        }

        $validator = \Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }
}

