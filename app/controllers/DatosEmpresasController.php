<?php

class DatosEmpresasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /datosempresas
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /datosempresas/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /datosempresas
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /datosempresas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /datosempresas/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /datosempresas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /datosempresas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
        
        public function getPdfc46movil() {

        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('l', 'letter');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(130, 10, 'Cliente: Claro', 0, 0, 'L');
        $pdf->Cell(40, 10, 'Fecha: ' . date('d-m-Y'), 0, 1, 'L');
        $pdf->Cell(10, 10, 'Producto: Ciclo C-46 Movil', 0, 1, 'L');
        $pdf->SetX(5);
        $pdf->Cell(7, 10, 'N°', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Codigo', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Nombre', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Tipo Cliente', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Estado', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Observaci�n', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Comentario', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Mensajero', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Ciudad', 1, 1, 'C');
        $contador = DB::table('ciclos')->where('id', 6)->get();
        $datos = DB::table('datos_empresas')
                ->where('empresas_id', 1)
                ->where('ciclo_id', 6)
                ->where('contador', ($contador[0]->contador - 1))
                ->get();
        $i = 0;
        foreach ($datos AS $variable):
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
            $observacion = Observacione::find($variable->observacion_id);
            if ($observacion == NULL): $observaciones = '';
            else: $observaciones = $observacion['name'];
            endif;
            $pdf->Cell(7, 5, $i, 1, 0);
            $pdf->Cell(15, 5, $variable->codigo, 1, 0);
            $pdf->Cell(60, 5, substr($variable->name_cliente, -35), 1, 0);
            $pdf->Cell(30, 5, substr($variable->tipo_cliente, -35), 1, 0);
            $pdf->Cell(20, 5, $estados, 1, 0);
            $pdf->Cell(45, 5, utf8_decode($observaciones), 1, 0);
            $pdf->Cell(30, 5, $variable->comentario, 1, 0);
            $pdf->Cell(25, 5, $mensajeros, 1, 0);
            $pdf->Cell(35, 5, $ciudades, 1, 1);
        endforeach;

        $pdf->Output();
        exit;
    }
}