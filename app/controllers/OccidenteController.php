<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OccidenteController
 *
 * @author Sistemas Amigables
 */
class OccidenteController extends BaseController {
    
     public function getIndex() {
       
        if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',6)
                    ->where('ciclo_id',11)
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',6)
                    ->where('ciclo_id',11)
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
        return View::make('occidentes.index', array('resultado' => $paginacion));
    }
    /*
     * Con esta accion mostramos a vista de crear
     */     
    public function getCreate(){
        return View::make('occidentes.create');
    }
    /*
     * Con esta accion agregamos los datos a la tabla 
     */      
    public function postCreate(){
        
        $input = Input::all();
       $reglas = array(
           'fechacheque'=>'required',
           'nombre'=>'required',
           'valor'=>'required'
       );
       $mensaje =array(
           'required'=>'Este campo es obligatorio',
       );
       $validar = Validator::make($input,$reglas,$mensaje);
       if($validar->fails()):
           return Redirect::back()->withErrors($validar);
       else:
          
           DB::insert('insert into datos_empresas (fecha, name_cliente,estado_id,monto,empresas_id,usuario_id,mes,year,ciclo_id) values (?, ?,?,?,?,?,?,?,?)', 
                   array($input['fechacheque'],$input['nombre'],1,$input['valor'],6,Auth::user()->id,date('m'),date('Y'),11));
         return View::make('occidentes.create')->with('datos', $input);
       endif;
    }
    /* ESTADO DE CUENTA */
        /*
     * Con esta accion mostramos a vista de crear
     */     
    public function getEstadocuenta(){
         $data= DB::table('ciclos')->where('id',12)->get();
         if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',6)
                    ->where('ciclo_id',12)
                    ->where('contador',($data[0]->contador-1))
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',6)
                    ->where('ciclo_id',12)
                    ->where('contador',($data[0]->contador-1))
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
        return View::make('occidentes.estadocuenta', array('resultado' => $paginacion));
    }
    public function getImportarestadocuenta(){
               
         return View::make('occidentes.importarestadocuenta');
    }
    public function postImportarestadocuenta(){
              $input = Input::all();
               Excel::load($input['importar'],function($archivo){
            $result=$archivo->get();
             $data= DB::table('ciclos')->where('id',12)->get();
            foreach ($result As $key=>$value):
               DB::insert('insert into datos_empresas ( name_cliente,estado_id,codigo,phone,empresas_id,usuario_id,mes,year,ciclo_id,contador) values ( ?,?,?,?,?,?,?,?,?,?)', 
                   array($value['nombre'],1,$value['cuenta'],$value['telefono'],6,Auth::user()->id,date('m'),date('Y'),12,$data[0]->contador));
            endforeach;
        })->get();
        $ciclo=12;
             $input = Input::all();
         $data= DB::table('ciclos')->where('id',$ciclo)->get();
         $contador=$data[0]->contador+1;
        DB::update("UPDATE ciclos SET contador = $contador WHERE id= ". $ciclo);
         return Redirect::to('occidentes/estadocuenta');
    }
   
    public function getEstadopdf() {
       
        $html = "<html>
            <body>"
        . "<table border='0' cellpadding='0' cellspacing='0'>
              <tbody>
                <tr>
                  <td width='32'><img src='../public/img/logo-corso_pdf.jpg'></td>
                  <td width='360'><center><h1>Reporte de Entrega</h1></center></td>
                </tr>
              </tbody>
            </table>"
        . "<table width='558' border='0' cellpadding='0' cellspacing='0'>
  				<tbody style='font-size:12px;'>
					<tr>
					  <td width='70' bgcolor='#DDDDDD'>Cliente: </td>
					  <td width='241'>Banco Occidente</td>
					  <td width='60' bgcolor='#DDDDDD'>Fecha:</td>
					  <td width='187'>".date('d-m-Y')."</td>
					</tr>
					<tr>
					  <td bgcolor='#DDDDDD'>Producto: </td>
					  <td>Estado de Cuenta</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
				  </tbody>
				</table>
				<br>"
        . "<table width='100%' border='0' cellpadding='0' cellspacing='0'>
				<thead style='font-size:12px; color:#fff;'>
					<tr bgcolor='#18375b'>
						<th height='20'>#</th>
						<th>Cuenta No</th>
						<th>Nombre</th>
						<th>Estado</th>
						<th>Comentario</th>
						<th>".utf8_decode('Teléfono')."</th>
						<th>Mensajero</th>
					</tr>      
				</thead>"
        ." <tbody style='font-size:12px;'>"; ?><?php
        // var_dump($html);
         $contador = DB::table('ciclos')->where('id', 12)->get();
        $conta = ($contador[0]->contador - 1);
        $datos = DB::table('datos_empresas')
        ->where('empresas_id', 6)
        ->where('ciclo_id', 12)
        ->where('contador',$conta)
        ->get();

        $i = 0;
        $hml ="";
        foreach ($datos AS $variable): $i++;
        $estado = Estado::find($variable->estado_id);
        if($estado['id'] > 0): $estados = $estado['name'];
        else: $estados = ''; endif;
        $mensajero = Empleado::find($variable->mensajero_id);
        if($mensajero==NULL): $mensajeros = '';
        else: $mensajeros = $mensajero['fname'].' '.$mensajero['flast'];
        endif;
       
       $hml .="<tr>
						  <td>$i</td>
						  <td>$variable->codigo</td>
						  <td>".utf8_decode($variable->name_cliente)."</td>
						  <td>$estados</td>
						  <td>$variable->comentario</td>
						  <td>$variable->phone</td>
						  <td>$mensajeros</td>
						</tr>";
           endforeach; 
        $htm ="</tbody></table>"
        . "</body></html>";
      $variables=$html.$hml.$htm;
   
       return PDF::load($variables, 'letter', 'portrait')->show();
 
    }

    public function getExcel() {
        Excel::create('ReportedeEntrega', function($excel) {
            $excel->sheet('Reporte', function($sheet) {
                $sheet->setPageMargin(0.5);
                $sheet->setBorder('A7:G7', 'thin');
                $sheet->mergeCells('A1:G1');
                $sheet->cells('A1:G1', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('center');
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                    $cells->setValignment('middle');
                });
                $sheet->cells('D1:G1', function($cells) {
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('B4', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('right');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('B5', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('right');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('E4', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('right');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('A7:G7', function($cells) {
                    $cells->setbackground('#18375b');
                    $cells->setFontColor('#ffffff');
                });
                $data = [];
                array_push($data, array('Reporte de Entrega', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', 'Cliente: Banco Occidente', '', '', 'Fecha:'.date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: Estados de Cuenta'), '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Cuenta Nº', 'Nombre', 'Estado', 'Comentario', 'Teléfono', 'Mensajero'));
                $contador = DB::table('ciclos')->where('id', 12)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 6)
                        ->where('ciclo_id', 12)
                        ->where('contador', ($contador[0]->contador - 1))
                        ->get();
                $i = 0;
                foreach ($datos AS $variable): $i++;
                    $estado = Estado::find($variable->estado_id);
                    if ($estado['id'] > 0): $estados = $estado['name'];
                    else: $estados = "No tiene";
                    endif;
                    $mensajero = Empleado::find($variable->mensajero_id);
                    if ($mensajero == NULL): $mensajeros = "No tiene";
                    else: $mensajeros = $mensajero['fname'] . ' ' . $mensajero['flast'];
                    endif;
                    array_push($data, array($i, $variable->codigo, $variable->name_cliente, $estados, $variable->comentario, $variable->phone,));
                endforeach;

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }
 public function getCkpdf() {
        $datos = DB::table('datos_empresas')
        ->where('empresas_id', 6)
        ->where('ciclo_id', 11)
        ->get();
        $i = 0;
        $html = "<html><title>Reporte</title><body>"
        . "<table border='0' cellpadding='0' cellspacing='0'>
              <tbody>
                <tr>
                  <td width='32'><img src='../public/img/logo-corso_pdf.jpg'></td>
                  <td width='360'><center><h1>Reporte de Entrega</h1></center></td>
                </tr>
              </tbody>
            </table>"
        . "<table width='558' border='0' cellpadding='0' cellspacing='0'>
  				<tbody style='font-size:12px;'>
					<tr>
					  <td width='70' bgcolor='#DDDDDD'>Cliente: </td>
					  <td width='241'>Banco Occidente</td>
					  <td width='60' bgcolor='#DDDDDD'>Fecha:</td>
					  <td width='187'>".date('d-m-Y')."</td>
					</tr>
					<tr>
					  <td bgcolor='#DDDDDD'>Producto: </td>
					  <td>Cheques Devueltos</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
				  </tbody>
				</table>
				<br>"
        . "<table width='100%' border='0' cellpadding='0' cellspacing='0'>
				<thead style='font-size:12px; color:#fff;'>
					<tr bgcolor='#18375b'>
						<th height='20'>#</th>
						<th>Fecha Cheque</th>
						<th>Nombre</th>
						<th>Valor</th>
						<th>Estado</th>
						<th>".utf8_decode('Comentario')."</th>
						<th>Mensajero</th>
					</tr>      
				</thead>"
        ." <tbody style='font-size:12px;'>" ?><?php $hml ="";
        foreach ($datos AS $variable): $i++;
        $estado = Estado::find($variable->estado_id);
        if($estado['id'] > 0): $estados = $estado['name'];
        else: $estados = '';
        endif;
        $mensajero = Empleado::find($variable->mensajero_id);
        if($mensajero==NULL): $mensajeros = '';
        else: $mensajeros = $mensajero['fname'].' '.$mensajero['flast'];
        endif;
       $hml .="<tr>
						  <td>$i</td>
						  <td>$variable->fecha</td>
						  <td>$variable->name_cliente</td>
						  <td>$variable->monto</td>
						  <td>$estados</td>
						  <td>$variable->comentario</td>
						  <td>$mensajeros</td>
						</tr>";
        endforeach; 
        $htm ="</tbody></table>"
        . "</body></html>";
 return PDF::load($html.$hml.$htm, 'letter', 'portrait')->show();
    }

    public function getCKexcel() {
        Excel::create('ReportedeEntrega', function($excel) {
            $excel->sheet('Reporte', function($sheet) {
                $sheet->setPageMargin(0.5);
                $sheet->setBorder('A7:G7', 'thin');
                $sheet->mergeCells('A1:G1');
                $sheet->cells('A1:G1', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('center');
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                    $cells->setValignment('middle');
                });
                $sheet->cells('D1:G1', function($cells) {
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('B4', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('right');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('B5', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('right');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('E4', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('right');
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('A7:G7', function($cells) {
                    $cells->setbackground('#18375b');
                    $cells->setFontColor('#ffffff');
                });
                $data = [];
                array_push($data, array('Reporte de Entrega', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', 'Cliente: Banco Occidente', '', '', 'Fecha:'.date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: '), 'Cheque Devuelto', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Fecha Cheque', 'Nombre', 'Valor',  'Estado','Comentario', 'Mensajero'));
                 $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 6)
                        ->where('ciclo_id', 11)
                        ->get();
                $i = 0;
                foreach ($datos AS $variable): $i++;
                    $estado = Estado::find($variable->estado_id);
                    if ($estado['id'] > 0): $estados = $estado['name'];
                    else: $estados = "No tiene";
                    endif;
                    $mensajero = Empleado::find($variable->mensajero_id);
                    if ($mensajero == NULL): $mensajeros = "No tiene";
                    else: $mensajeros = $mensajero['fname'] . ' ' . $mensajero['flast'];
                    endif;
                    array_push($data, array($i, $variable->fecha, $variable->name_cliente, $variable->monto, $estados, $variable->comentario,$mensajeros));
                endforeach;

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }
}
