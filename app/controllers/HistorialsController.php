<?php

class HistorialsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /historials
	 *
	 * @return Response
	 */
	public function index()
	{
		$historial = Historial::all();
		return View::make('historial',compact('historial'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /historials/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /historials
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /historials/{id}
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
	 * GET /historials/{id}/edit
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
	 * PUT /historials/{id}
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
	 * DELETE /historials/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function descargasProducto($id){

		$historial = Historial::find($id);
		$separar =  explode('/',$historial->url);
		$quitarExtencion = explode('.',$separar[2]);
		$data=array(array('Codigo',
			'Tipo Cliente',
			'Telefono',
			'Nombre Cliente',
			'Ciudad',
			'Comentario',
			'Fecha Entrega',
			'fecha recibido',
			'monto',
			'direccion',
			'comentario ciudad','observaciones','empleados'));
		foreach ($historial->datosEmpresas as $value):  
			
			$data[]=
		array($value->codigo,
				$value->tipo_cliente,
				$value->telefono,
				$value->name_cliente,
				$value->ciudades->name,
				$value->comentario,
				$value->fecha_entregado,
				$value->fecha_recibido,
				$value->monto,
				$value->direccion,
				$value->comentario_ciudad,
				$value->observaciones->name
				);
//
		endforeach;
		 dd($data);
	Excel::create($quitarExtencion[0], function($excel) use ($data) {
	
$excel->sheet('Datos Descargados', function($sheet) use ($data) {
		$sheet->fromArray($data);
});
})->download('xlsx');
		
			
	}

}