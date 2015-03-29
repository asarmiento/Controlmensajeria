<?php


class ClaroController extends \BaseController {

    /**
     * Display a listing of the resource.
     * GET /claro
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /claro/create
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /claro
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     * GET /claro/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /claro/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /claro/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /claro/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }
    
    public function dataPoduct(){
        $product = Producto::where('empresas_id','=',1);
        return View::make('claro.product',  compact('product'));
    }

    /**
     * Mostramos todos los datos en la vista de la tabla Datos empresas de claro
     * @return type
     */
   public function ListaDatosEmpresas() {
        $datosEmpresas = DatosEmpresa::paginate(100);
        return View::make('claros.listaDatosEmpresas', compact('datosEmpresas'));
    }
    /**
     * aqui ejecutamos todos los metodos para agregar un nuevo archivo o reemplazarlo
     */
    public function importarExcelClaro() {
        set_time_limit(0);
        ini_set('memory_limit', '20240M');
        /* de claramos las variables que recibimos por post */
        $mes = Input::get('mes');
        $year = Input::get('year');
        $producto = Input::get('productos_id');
        $file = Input::file('excel');
        $url = "files/claro/CICLO" . $producto . str_pad($mes, 2, '0', STR_PAD_LEFT) . $year . ".xlsx";


        /* agregamos un nuevo historial y retornamos el ID o buscamos regresamos el ID */
        $idHistorial = HistorialsController::SaveHistorials($mes, $year, $producto, $url);

        /* Corremos el archivo de excel y lo convertimos en un array */
        $excel = EmpresasController::uploadExcel($file, 'claro', 'CICLO' . $producto . str_pad($mes, 2, '0', STR_PAD_LEFT) . $year . '.xlsx');

        return $this->saveExcel($excel, $idHistorial);
    }

    

    private function saveExcel($data, $historial) {

        $datos = DatosEmpresa::where('historials_id', '=', $historial)->delete();

        //   dd($data);
        foreach ($data AS $dataExcel):
            $datos_empresas = new DatosEmpresa;
            $datos_empresas->barra = null;
            if (empty($dataExcel['codigo'])):
                $datos_empresas->codigo = null;
            else:
                $datos_empresas->codigo = $dataExcel['codigo'];
            endif;
            if (empty($dataExcel['tipo_cliente'])):
                $datos_empresas->tipo_cliente = null;
            else:
                $datos_empresas->tipo_cliente = $dataExcel['tipo_cliente'];
            endif;
            if (empty($dataExcel['telefono'])):
                $datos_empresas->telefono = null;
            else:
                $datos_empresas->telefono = $dataExcel['telefono'];
            endif;
            if (empty($dataExcel['nombre_cliente'])):
                $datos_empresas->name_cliente = null;
            else:
                $datos_empresas->name_cliente = $dataExcel['nombre_cliente'];
            endif;
            if (empty($dataExcel['comentario'])):
                $datos_empresas->comentario = null;
            else:
                $datos_empresas->comentario = $dataExcel['comentario'];
            endif;
            if (empty($dataExcel['fecha_entrega'])):
                $datos_empresas->fecha_entregado = null;
            else:
                $datos_empresas->fecha_entregado = $dataExcel['fecha_entrega'];
            endif;
            if (empty($dataExcel['fecha_recibido'])):
                $datos_empresas->fecha_recibido = null;
            else:
                $datos_empresas->fecha_recibido = $dataExcel['fecha_recibido'];
            endif;
            if (empty($dataExcel['monto'])):
                $datos_empresas->monto = null;
            else:
                $datos_empresas->monto = $dataExcel['monto'];
            endif;
            if (empty($dataExcel['direccion'])):
                $datos_empresas->direccion = null;
            else:
                $datos_empresas->direccion = $dataExcel['direccion'];
            endif;
            if (empty($dataExcel['comentario_ciudad'])):
                $datos_empresas->comentario_ciudad = null;
            else:
                $datos_empresas->comentario_ciudad = $dataExcel['comentario_ciudad'];
            endif;
            $datos_empresas->ciudades_id = Ciudade::convertionCiudad($dataExcel['ciudad']);
            if (empty($dataExcel['observaciones'])):
                $datos_empresas->observaciones_id = 16;
            else:
                $datos_empresas->observaciones_id = $dataExcel['observaciones'];
            endif;
            $datos_empresas->historials_id = $historial;
            if (empty($dataExcel['empleados'])):
                $datos_empresas->empleados_id = null;
            else:
                $datos_empresas->empleados_id = $dataExcel['empleados'];
            endif;
            $datos_empresas->save();
        endforeach;
        return Redirect::to('claro/ciclo')->with('messege', 'se guardo con exito!!');
    }

}
