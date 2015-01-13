<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AtlantidadController
 *
 * @author Sistemas Amigables
 */
class AtlantidadController extends BaseController {

    public function getIndex() {
   
        if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars($_GET['buscar']);
           if((Session::get('estado'))): $estados=Session::get('estado'); else:   $estados="";    endif;
    
            if($estados>0): 
                $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id','=', 3)
                    ->where('ciclo_id','=', 8)
                    ->where('estado_id','=', $estados)
                    ->where('name_cliente','LIKE', '%'.$buscar.'%')
                    ->orwhere('monto','LIKE', '%'.$buscar.'%')
                    ->orwhere('fecha_entregado','LIKE','%'.$buscar.'%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
            
            else: 
                 $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 3)
                    ->where('ciclo_id', 8)
                    ->where('name_cliente','LIKE', '%'.$buscar.'%')
                    ->orwhere('monto','LIKE', '%'.$buscar.'%')
                    ->orwhere('fecha_entregado','LIKE','%'.$buscar.'%')
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
            endif;  
            
        } elseif(isset($_GET['estado'])){ 
            Session::put('estado',$_GET['estado']); 
             $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 3)
                    ->where('ciclo_id', 8)
                    ->where('estado_id', $_GET['estado'])
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }else {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 3)
                    ->where('ciclo_id', 8)
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
        $drop = DB::table('estados')->lists('name', 'id');
        return View::make('atlantidads.index', array('resultado' => $paginacion,'estado'=>$drop));
    }

    public function getCreate() {
        return View::make('atlantidads.create');
    }

    public function postCreate() {

        $input = Input::all();


        DB::insert('insert into datos_empresas (fecha, name_cliente,estado_id,tipo_cliente,codigo,ciudad_id,forranea,empresas_id,usuario_id,mes,year,ciclo_id) 
                values (?, ?,?,?,?,?,?,?,?,?,?,?)', array($input['fecha_recibido'], $input['nombre'], 1, $input['tipo_tarjeta'], $input['tarjeta'], $input['ciudad'], $input['foranea'], 3, Auth::user()->id, date('m'), date('Y'), 8));

        return View::make('atlantidads.create')->with('datos', $input);
    }

    public function getEstadocuentas() {

        $data = DB::table('ciclos')->where('id', 9)->get();
      
        if (isset($_GET['buscar'])) {
            $buscar = htmlspecialchars(Input::get('buscar'));
           
           if((Session::get('estado'))): $estados=Session::get('estado');else:   $estados="";    endif;
              
            if($estados>0):
                $where= "empresas_id = 3 AND ciclo_id = 9 AND contador = ".($data[0]->contador - 1)." AND estado_id= $estados AND ("
                    . "name_cliente LIKE %$buscar% OR monto LIKE %$buscar% OR fecha_entregado LIKE %$buscar% )";
            else:
                  $where= "empresas_id = 3 AND ciclo_id = 9 AND contador = ".($data[0]->contador - 1)." AND ( "
                    . "name_cliente LIKE %$buscar% OR monto LIKE %$buscar% OR fecha_entregado LIKE %$buscar% )";
            endif;  
            $paginacion = DB::table("datos_empresas")
                    ->where($where)
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        } elseif(isset ($_GET['estado'])){ 
             Session::put('estado',$_GET['estado']); 
              $where= "empresas_id = 3 AND ciclo_id = 9 AND contador = ".($data[0]->contador - 1)." AND estado_id = ". $_GET['estado'] ;
            
             $paginacion = DB::table("datos_empresas")
                    ->where($where)
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }else
                {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 3)
                    ->where('ciclo_id', 9)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('id', 'DESC')
                    ->paginate(15);
        }
        
         $drop = DB::table('estados')->lists('name', 'id');
        return View::make('atlantidads.estadocuentas', array('resultado' => $paginacion,'estado'=>$drop));
    }

    public function getImportarestadoscuenta() {
        return View::make('atlantidads.importarestadoscuenta');
    }

    public function postImportarestadocuenta() {
        $input = Input::all();
        Excel::load($input['importar'], function($archivo) {
            $result = $archivo->get();
            $data = DB::table('ciclos')->where('id', 9)->get();
            foreach ($result As $key => $value): //var_dump($value); exit;
                DB::insert('insert into datos_empresas (codigo, name_cliente,direccion,phone,estado_id,empresas_id,usuario_id,mes,year,ciclo_id,contador) values (?, ?,?,?,?,?,?,?,?,?,?)', array($value['cliente'], $value['nombre'], $value['direcciones'], $value['telefonos'], 1, 3, Auth::user()->id, date('m'), date('Y'), 9, $data[0]->contador));
            endforeach;
        })->get();

        $input = Input::all();
        $data = DB::table('ciclos')->where('id', 9)->get();
        $contador = $data[0]->contador + 1;
        DB::update("UPDATE ciclos SET contador = $contador WHERE id= " . 9);
        return Redirect::to('atlantidads/estadocuentas');
    }

    public function getDelete($id) {
        DB::table('datos_empresas')->where('id',$id)->delete();
         return Redirect::to('atlantidads/index');
    }

    public function getPdf() {
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('p', 'letter');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(130, 10, 'Cliente: Banco Atlantida', 0, 0, 'L');
        $pdf->Cell(40, 10, 'Fecha: ' . date('d-m-Y'), 0, 1, 'L');
        $pdf->Cell(10, 10, 'Producto: Estado de Cuentas', 0, 1, 'L');
        $pdf->SetX(5);
        $pdf->Cell(10, 10, 'Nº', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Nº Cliente', 1, 0, 'C');
        $pdf->Cell(75, 10, 'Nombre', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Estado', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Comentario', 1, 0, 'C');
        $pdf->Cell(18, 10, 'Teléfono', 1, 0, 'C');
        $pdf->Cell(23, 10, 'Mensajero', 1, 1, 'C');
        $data = DB::table('ciclos')->where('id', 9)->get();
        $datos = DB::table("datos_empresas")
                        ->where('empresas_id', 3)
                        ->where('ciclo_id', 9)
                        ->where('contador', ($data[0]->contador - 1))
                        ->orderBy('id', 'DESC')->get();

        $i = 0;
        foreach ($datos AS $variable):
            $pdf->SetX(5);
            $pdf->SetFont('Times', '', 10);
            $i++;
            $estado = Estado::find($variable->estado_id);
            if ($estado['id'] > 0): $estados = $estado['name'];
            else: $estados = '';
            endif;
            $mensajero = Empleado::find($variable->mensajero_id);
            if ($mensajero == NULL): $mensajeros = '';
            else: $mensajeros = $mensajero['fname'] . ' ' . $mensajero['flast'];
            endif;
            $pdf->Cell(10, 10, $i, 1, 0);
            $pdf->Cell(35, 10, $variable->codigo, 1, 0);
            $pdf->Cell(75, 10, $variable->name_cliente, 1, 0);
            $pdf->Cell(20, 10, $estados, 1, 0);
            $pdf->Cell(25, 10, $variable->comentario, 1, 0);
            $pdf->Cell(18, 10, $variable->phone, 1, 0);
            $pdf->Cell(23, 10, $mensajeros, 1, 1);
        endforeach;

        $pdf->Output();
        exit;
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
                array_push($data, array('', 'Cliente: ', 'Banco Atlantida', '', 'Fecha:', date('d-m-Y'), ''));
                array_push($data, array('', utf8_decode('Producto: '), 'Estados de Cuenta', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('NÂº', 'Cuenta NÂº', 'Nombre', 'Estado', 'Comentario', 'TelÃ©fono', 'Mensajero'));
                $contador = DB::table('ciclos')->where('id', 9)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 3)
                        ->where('ciclo_id', 9)
                        ->where('contador', ($contador[0]->contador - 1))
                        ->get();
                $i = 0;
                foreach ($datos AS $variable): $i++;
                    $estado = Estado::find($variable->estado_id);
                    if ($estado['id'] > 0): $estados = $estado['name'];
                    else: $estados = "No tiene";
                    endif;
                    $mensajero = Empleado::find($variable->mensajero_id);
                    if ($mensajero == NULL): $mensajeros = "";
                    else: $mensajeros = $mensajero['fname'] . ' ' . $mensajero['flast'];
                    endif;
                    array_push($data, array($i, $variable->codigo, $variable->name_cliente, $estados, $variable->comentario, $variable->phone, $mensajeros));
                endforeach;

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }

    public function getCkpdf() {
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('l', 'letter');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(130, 10, 'Cliente: Banco Atlantida', 0, 0, 'L');
        $pdf->Cell(40, 10, 'Fecha: ' . date('d-m-Y'), 0, 1, 'L');
        $pdf->Cell(10, 10, 'Producto: Tarjetas de Credito', 0, 1, 'L');
        $pdf->SetX(5);
        $pdf->Cell(10, 10, 'Nº', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Nombre', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Tipo Tarjeta', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Nº Tarjeta', 1, 0, 'C');
        $pdf->Cell(18, 10, 'Estado', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Comentario', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Fecha Entrega', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Mensajero', 1, 0, 'C');
        $pdf->Cell(32, 10, 'Ciudad', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Ciudad Foranea', 1, 1, 'C');
        $dato = DB::table('datos_empresas')
                ->where('empresas_id', 3)
                ->where('ciclo_id', 8)
                ->get();
        $i = 0;
        $hml = "";
        foreach ($dato AS $variable):
            $pdf->SetFont('Times', '', 8);
            $i++;
            $pdf->SetX(5);
            $estado = Estado::find($variable->estado_id);
            if ($estado['id'] > 0): $estados = $estado['name'];
            else: $estados = '';
            endif;
            $mensajero = Empleado::find($variable->mensajero_id);
            if ($mensajero == NULL): $mensajeros = '';
            else: $mensajeros = $mensajero['fname'] . ' ' . $mensajero['flast'];
            endif;
            $ciudad = Ciudade::find($variable->ciudad_id);
            if ($ciudad == NULL): $ciudades = '';
            else: $ciudades = $ciudad['name'];
            endif;
            $pdf->Cell(10, 5, $i, 1, 0, 'L');
            $pdf->Cell(50, 5, substr($variable->name_cliente, -27), 1, 0, 'L');
            $pdf->Cell(30, 5, $variable->tipo_cliente, 1, 0, 'C');
            $pdf->Cell(25, 5, $variable->codigo, 1, 0, 'C');
            $pdf->Cell(18, 5, $estados, 1, 0, 'C');
            $pdf->Cell(25, 5, $variable->comentario, 1, 0, 'C');
            $pdf->Cell(25, 5, $variable->fecha_entregado, 1, 0, 'C');
            $pdf->Cell(25, 5, $mensajeros, 1, 0, 'C');
            $pdf->Cell(32, 5, $ciudades, 1, 0, 'C');
            $pdf->Cell(30, 5, $variable->forranea, 1, 1, 'C');
        endforeach;

        $pdf->Output();
        exit;
    }

    public function getCKexcel() {
        Excel::create('ReportedeEntrega', function($excel) {
            $excel->sheet('Reporte', function($sheet) {
                $sheet->setPageMargin(0.5);
                $sheet->setBorder('A7:G7', 'thin');
                $sheet->mergeCells('A1:G1');
                $sheet->cells('A1:J1', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('center');
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                    $cells->setValignment('middle');
                });
                $sheet->cells('D1:J1', function($cells) {
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
                $sheet->cells('A7:J7', function($cells) {
                    $cells->setbackground('#18375b');
                    $cells->setFontColor('#ffffff');
                });
                $data = [];
                array_push($data, array('Reporte de Entrega', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', 'Cliente: ', 'Banco Atlantida', '', 'Fecha:' . date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: '), 'Tarjetas de CrÃ©dito', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('#', 'Nombre', 'Tipo Tarjeta', '# Tarjeta', 'Estado', 'Comentario', 'Fecha Entrega', 'Mensajero', 'Ciudad', 'Ciudad Foranea'));
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 3)
                        ->where('ciclo_id', 8)
                        ->get();
                $i = 0;
                foreach ($datos AS $variable): $i++;
                    $estado = Estado::find($variable->estado_id);
                    if ($estado['id'] > 0): $estados = $estado['name'];
                    else: $estados = "";
                    endif;
                    $mensajero = Empleado::find($variable->mensajero_id);
                    if ($mensajero == NULL): $mensajeros = "";
                    else: $mensajeros = $mensajero['fname'] . ' ' . $mensajero['flast'];
                    endif;
                    $ciudad = Ciudade::find($variable->ciudad_id);
                    if ($ciudad == NULL): $ciudades = '';
                    else: $ciudades = $ciudad['name'];
                    endif;
                    array_push($data, array($i, $variable->name_cliente, $variable->tipo_cliente, $variable->codigo, $estados, $variable->comentario, $variable->fecha_entregado, $mensajeros, $ciudades, $variable->forranea));
                endforeach;

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }

}
