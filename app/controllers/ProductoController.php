<?php

class ProductoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /producto
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /producto/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /producto
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /producto/{id}
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
	 * GET /producto/{id}/edit
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
	 * PUT /producto/{id}
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
	 * DELETE /producto/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getProduct($name){

        $separador = explode('-', ($name));
        
        $nameProducto = ucwords($separador[0]).' '.ucwords($separador[1]).'-'.$separador[2];

       $producto = Producto::where('name','=',$nameProducto)->get();

       if($producto->isEmpty()):
            return "No se encontro el producto que intenta buscar";
        endif;

        return $producto[0]->id;
    }

}