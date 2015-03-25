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
		$empleado = new Empleado($empleados);
		
		/* Validamos los datos para guardar tabla menu */
        if ($empleado->isValid((array) $empleados)):
        	$empleado->fill($empleados);
		$empleado->save();
		/* Enviamos el mensaje de guardado correctamente */
            return Redirect::route('ver-empleados')->with(array('message'=>'Los datos se guardaron con exito!!!'));
        	endif;
		 /* Enviamos el mensaje de error */
		 return Redirect::route('registrar-empleados')->withInput()->withErrors($empleado->errors);
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
		$empleado = Empleado::find($id);

		$ciudades = Ciudade::lists('name','id');
		
		return View::make('empleados.edit',compact('empleado','ciudades'));
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
		$empleados = Input::all();

		$empleado =  Empleado::find($empleados['id']);
		
		/* Validamos los datos para guardar tabla menu */
			$empleado->fill($empleados);
			$empleado->save();

		/* Enviamos el mensaje de guardado correctamente */
            return Redirect::route('ver-empleados')->with(array('message'=>'Los datos se guardaron con exito!!!'));
       
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