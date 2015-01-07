<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralController
 *
 * @author Sistemas Amigables
 */
class GeneralController extends BaseController{
    /*
     * Con esta accion mostramos a vista de crear
     */  
      public function postUpdatefecha(){
          $input =Input::all();
          $array =array("fecha_entregado"=>$input['fecha_entregado']);
 
          DB::table('datos_empresas')
        ->where('id',$input['campoid'])
        ->update($array);
     }
 /*
     * Con esta accion mostramos a vista de crear
     */  
      public function postUpdateobservacion(){
          $input =Input::all();
          $array =array("observacion_id"=>$input['observacion_id']);
 
          DB::table('datos_empresas')
        ->where('id',$input['campoid'])
        ->update($array);
     }
   /*
     * Con esta accion mostramos a vista de crear
     */  
      public function postUpdatecomentario(){
          $input =Input::all();
          $array =array("comentario"=>$input['comentario']);
 
          DB::table('datos_empresas')
        ->where('id',$input['campoid'])
        ->update($array);
     }     
    /*
     * Con esta accion mostramos a vista de crear
     */  
      public function postUpdate(){
          $input =Input::all();
          $array =array("estado_id"=>$input['estado_id'],"observacion_id"=>$input['observacion_id'],"comentario"=> $input['comentario']);
 
          DB::table('datos_empresas')
        ->where('id',$input['campoid'])
        ->update($array);
     }
    /*
     * Con esta accion mostramos a vista de crear
     */  
      public function postUpdatemensajero(){
          $input =Input::all();
      DB::table('datos_empresas')
        ->where('id',$input['id'])
        ->update($input);

      $data = Empleado::find($input['mensajero_id']);
      echo $data['fname'].' '.$data['flast'] ;
      }  
      
      /*
     * Con esta accion mostramos a vista de crear
     */  
      public function getChangobservacion(){
        
           $consulta = DB::table("observaciones")
                   ->select('observaciones.name','observaciones.id') 
                   ->join('observacion_estados','observacion_estados.observacion_id','=','observaciones.id')
                    ->where('observaciones.estado_id',$_GET['id'])
                   ->where('observacion_estados.estado_empresas_id',$_GET['empresas'])
                   ->orderBy('name','ASC')->get();
           echo "<option value=''>Elija Una Observacion</option>";
            foreach ($consulta AS $data):
        echo "<option value='$data->id'>$data->name</option>";
    endforeach;
          
    
      }  
       /*
     * Con esta accion mostramos a vista de crear
     */  
      public function getObservacion(){
          
           $consulta = DB::table("observaciones")
                   ->select('observaciones.name','observacion_estados.id') 
                   ->join('observacion_estados','observacion_estados.observacion_id','=','observaciones.id')
                    ->join('estado_empresas','estado_empresas.id','=','observacion_estados.estado_empresas_id')
                    ->where('observaciones.id',$_GET['id'])
                   ->orderBy('name','ASC')->get();
            foreach ($consulta AS $data):
        echo $data->name;
    endforeach;
          
    
      }  
      
      public function postBorrarsession(){
          Session::forget('ciudad');
           Session::forget('estado');
      }
}
