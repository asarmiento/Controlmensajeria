<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ciudade
 *
 * @author Sistemas Amigables
 */
class Ciudade extends Eloquent{
    //put your code here
    protected $table = 'ciudades';
    protected $fillable = ['name'];
    
     public static $rules=['name'=>'required'];
}
