<?php

class EmpleadoController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /empleados
	 *
	 * @return Response
	 */
	public function index()
	{
            $empleados = Empleado::paginate(15);
            return View::make('empleados.index', compact('empleados'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /empleados/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$ciudades = Ciudade::lists('name','id');
		return View::make('empleados.create',compact('ciudades'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /empleados
	 *
	 * @return Response
	 */
	public function store()
	{
		$empleados = Input::all();
		$empleado = new Empleado;
		/* Validamos los datos para guardar tabla menu */
        if ($empleado->isValid((array) $empleados)):
        	dd($empleados);
        	$empleado->cedula =$empleados;
        $empleado->fname=$empleados;
        $empleado->sname=$empleados;
        $empleado->flast=$empleados;
        $empleado->slast=$empleados;
        $empleado->celular=$empleados;
        $empleado->ciudades_id=$empleados;
		$empleado->save($empleados);
		/* Enviamos el mensaje de guardado correctamente */
            return $this->exito('Los datos se guardaron con exito!!!');
        	endif;
		 /* Enviamos el mensaje de error */
        return $this->errores($empleado->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /empleados/{id}
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
	 * GET /empleados/{id}/edit
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
	 * PUT /empleados/{id}
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
	 * DELETE /empleados/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}