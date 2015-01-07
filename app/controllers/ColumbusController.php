<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatalogoController
 *
 * @author Anwar Sarmiento
 */
class ColumbusController extends BaseController {

    //put your code here
    
      public function getIndex() {
         $data= DB::table('ciclos')->where('id',13)->get();
       if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',7)
                    ->where('ciclo_id',13)
                    ->where('contador',($data[0]->contador-1))
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',7)
                    ->where('ciclo_id',13)
                    ->where('contador',($data[0]->contador-1))
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
        return View::make('columbus.index', array('resultado' => $paginacion));
    }
    
     public function getImportar(){
               
         return View::make('columbus.importarvip');
    }
    public function postImportar(){
              $input = Input::all();
               Excel::load($input['importar'],function($archivo){
            $result=$archivo->get();
              $data= DB::table('ciclos')->where('id',13)->get();
            foreach ($result As $key=>$value):
               DB::insert('insert into datos_empresas ( name_cliente,estado_id,codigo,fecha,empresas_id,usuario_id,mes,year,ciclo_id,contador) values ( ?,?,?,?,?,?,?,?,?,?)', 
                   array($value['nombre'],1,$value['factura'],$value['fecha'],7,Auth::user()->id,date('m'),date('Y'),13,$data[0]->contador));
            endforeach;
        })->get();
         $ciclo=13;
             $input = Input::all();
         $data= DB::table('ciclos')->where('id',$ciclo)->get();
         $contador=$data[0]->contador+1;
        DB::update("UPDATE ciclos SET contador = $contador WHERE id= ". $ciclo);   
         return View::make('columbus.importarvip');
    }
       public function getPdf() {
        
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
         $contador = DB::table('ciclos')->where('id', 13)->get();
        $conta = ($contador[0]->contador - 1);
        $datos = DB::table("datos_empresas")
                    ->where('empresas_id',7)
                    ->where('ciclo_id',13)
                    ->where('contador',($conta))
                    ->orderBy('id', 'DESC')->get();

        $i = 0;
        $hml ="";
        foreach ($datos AS $variable): $i++;
        if($variable->estado_id > 0):
        $estado = Estado::find($variable->estado_id);
         $estados = $estado['name'];
        else: $estados = ''; endif;
        if($variable->mensajero_id>0): 
        $mensajero = Empleado::find($variable->mensajero_id);
       $mensajeros = $mensajero['fname'].' '.$mensajero['flast'];
        else:  $mensajeros = ''; 
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
    // var_dump($variables); exit;
       return PDF::load($variables, 'A4', 'portrait')->show();
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
                array_push($data, array('', 'Cliente: Columbus', '', '', 'Fecha:'.date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: Estados de Cuenta VIP'), '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Cuenta Nº', 'Nombre', 'Estado', 'Comentario', 'Teléfono', 'Mensajero'));
                $contador = DB::table('ciclos')->where('id', 13)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 7)
                        ->where('ciclo_id', 13)
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
}
