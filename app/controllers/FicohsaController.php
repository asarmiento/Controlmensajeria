<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FicohsaController
 *
 * @author Sistemas Amigables
 */
class FicohsaController extends BaseController {
    //put your code here
    
    public function getEstadocuentadolar(){
           $data= DB::table('ciclos')->where('id',14)->get();
       if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',14)
                    ->where('contador',($data[0]->contador-1))
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',14)
                    ->where('contador',($data[0]->contador-1))
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
        
        return View::make('ficohsas.estadocuentadolar', array('resultado' => $paginacion));
    }
        public function getEstadocuentalps(){
              $data= DB::table('ciclos')->where('id',15)->get();
        if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',15)
                    ->where('contador',($data[0]->contador-1))
                    ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                    ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id',5)
                    ->where('ciclo_id',15)
                    ->where('contador',($data[0]->contador-1))
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
         return View::make('ficohsas.estadocuentalps', array('resultado' => $paginacion));
    }
    
    public function getImportardolares(){
         return View::make('ficohsas.importardolares');
    }
    
    public function getImportarlempiras(){
        return View::make('ficohsas.importarlempiras');
    }
    
    public function postImportarlempiras(){
              $input = Input::all();
               Excel::load($input['importar'],function($archivo){
            $result=$archivo->get();
             $data= DB::table('ciclos')->where('id',15)->get();
            foreach ($result As $key=>$value):
               DB::insert('insert into datos_empresas ( name_cliente,estado_id,empresas_id,usuario_id,mes,year,ciclo_id,contador) values ( ?,?,?,?,?,?,?,?)', 
                   array($value['nombre'],1,5,Auth::user()->id,date('m'),date('Y'),15,$data[0]->contador));
            endforeach;
        })->get();
           $ciclo=15;
             $input = Input::all();
         $data= DB::table('ciclos')->where('id',$ciclo)->get();
         $contador=$data[0]->contador+1;
        DB::update("UPDATE ciclos SET contador = $contador WHERE id= ". $ciclo);   
         return Redirect::to('ficohsas/estadocuentalps');
    }
    public function postImportardolares(){
              $input = Input::all();
               Excel::load($input['importar'],function($archivo){
            $result=$archivo->get();            
           $data= DB::table('ciclos')->where('id',14)->get();
         foreach ($result As $value): 
                 DB::insert('insert into datos_empresas ( estado_id,empresas_id,usuario_id,mes,year,ciclo_id,name_cliente,contador) values ( ?,?,?,?,?,?,?,?)', 
                   array(1,5,Auth::user()->id,date('m'),date('Y'),14,$value['nombre'],$data[0]->contador));
            endforeach;
        });
           $ciclo=14;
             $input = Input::all();
         $data= DB::table('ciclos')->where('id',$ciclo)->get();
         $contador=$data[0]->contador+1;
        DB::update("UPDATE ciclos SET contador = $contador WHERE id= ". $ciclo);   
         return Redirect::to('ficohsas/estadocuentadolar');
    }
        public function getPdfd() {
        $contador = DB::table('ciclos')->where('id', 14)->get();
        $datos = DB::table('datos_empresas')
        ->where('empresas_id', 5)
        ->where('ciclo_id', 14)
        ->where('contador', ($contador[0]->contador - 1))
        ->get();
        $i = 0;
        $html = "<html><body>"
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
					  <td width='241'>Banco Ficohsa</td>
					  <td width='60' bgcolor='#DDDDDD'>Fecha:</td>
					  <td width='187'>".date('d-m-Y')."</td>
					</tr>
					<tr>
					  <td bgcolor='#DDDDDD'>Producto: </td>
					  <td>Estado de Cuenta Dolares</td>
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
						  <td>$variable->codigo</td>
						  <td>$variable->name_cliente</td>
						  <td>$estados</td>
						  <td>$variable->comentario</td>
						  <td>$variable->phone</td>
						  <td>$mensajeros</td>
						</tr>";
        endforeach; 
        $htm ="</tbody></table>"
        . "</body></html>";
 return PDF::load($html.$hml.$htm, 'letter', 'portrait')->show();
    }

    public function getExceld() {
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
                array_push($data, array('', 'Cliente: Banco Ficohsa', '', '', 'Fecha:'.date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: Estados de Cuenta Dolares'), '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Cuenta Nº', 'Nombre', 'Estado', 'Comentario', 'Teléfono', 'Mensajero'));
                $contador = DB::table('ciclos')->where('id', 14)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 5)
                        ->where('ciclo_id', 14)
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
        public function getPdfl() {
        $contador = DB::table('ciclos')->where('id', 15)->get();
        $datos = DB::table('datos_empresas')
        ->where('empresas_id', 5)
        ->where('ciclo_id', 15)
        ->where('contador', ($contador[0]->contador - 1))
        ->get();
        $i = 0;
        $html = "<html><body>"
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
					  <td width='241'>Banco Ficohsa</td>
					  <td width='60' bgcolor='#DDDDDD'>Fecha:</td>
					  <td width='187'>".date('d-m-Y')."</td>
					</tr>
					<tr>
					  <td bgcolor='#DDDDDD'>Producto: </td>
					  <td>Estado de Cuenta Lempiras</td>
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
						  <td>$variable->codigo</td>
						  <td>$variable->name_cliente</td>
						  <td>$estados</td>
						  <td>$variable->comentario</td>
						  <td>$variable->phone</td>
						  <td>$mensajeros</td>
						</tr>";
        endforeach; 
        $htm ="</tbody></table>"
        . "</body></html>";
 return PDF::load($html.$hml.$htm, 'letter', 'portrait')->show();
    }

    public function getExcell() {
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
                array_push($data, array('', 'Cliente: Banco Ficohsa', '', '', 'Fecha:'.date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: Estados de Cuenta Lempiras'), '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Cuenta Nº', 'Nombre', 'Estado', 'Comentario', 'Teléfono', 'Mensajero'));
                $contador = DB::table('ciclos')->where('id', 15)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 5)
                        ->where('ciclo_id', 15)
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
