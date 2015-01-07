<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContinentalController
 *
 * @author Sistemas Amigables
 */
class ContinentalController extends BaseController {
   
      public function getEstadocuenta(){
             if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',15)
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',15)
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
         return View::make('continentals.estadocuenta', array('resultado' => $paginacion));
    }
     public function getEstadocuentatarjetas(){
             if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',15)
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',15)
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
         return View::make('continentals.estadocuentatarjetas', array('resultado' => $paginacion));
    }
     public function getNotasdebito(){
             if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',4)
                    ->where('ciclo_id',15)
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',4)
                    ->where('ciclo_id',15)
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
         return View::make('continentals.notasdebito', array('resultado' => $paginacion));
    }
    public function getCreate(){
        
    }
    public function getImportar(){
         $data= DB::table('ciclos')->where('empresas_id',4)->lists('name','id');
         return View::make('continentals.importar',array('drop'=>$data));
    }
    
    public function postImportar(){
          $input = Input::all();
            $ciclo=$_POST['ciclo'];
               Excel::load($input['importar'],function($archivo){
            $result=$archivo->get();            
           $data= DB::table('ciclos')->where('id',$_POST['ciclo'])->get();
          foreach ($result As $value): 
                 DB::insert('insert into datos_empresas ( estado_id,empresas_id,usuario_id,mes,year,ciclo_id,name_cliente,contador) values ( ?,?,?,?,?,?,?,?)', 
                   array(1,4,Auth::user()->id,$_POST['mes'],date('Y'),$_POST['ciclo'],$value['nombre'],$data[0]->contador));
            endforeach;
        });
         $input = Input::all();
         $data= DB::table('ciclos')->where('id',$ciclo)->get();
         $contador=$data[0]->contador+1;
        DB::update("UPDATE ciclos SET contador = $contador WHERE id= ". $input['ciclo']);
     
           if($ciclo==21):
                return Redirect::to('continentals/estadocuenta');
           elseif($ciclo==22):
               return Redirect::to('continentals/estadocuentatarjetas');
               elseif($ciclo==23):
                   return Redirect::to('continentals/notasdebito');
           endif;
    }
}
