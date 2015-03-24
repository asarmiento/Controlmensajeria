<?php

class EmpresasController extends \BaseController {

    /**
     * Display a listing of the resource.
     * GET /empresas
     *
     * @return Response
     */
    public function index() {
//
    }

    /**
     * Show the form for creating a new resource.
     * GET /empresas/create
     *
     * @return Response
     */
    public function create() {
//
    }

    /**
     * Store a newly created resource in storage.
     * POST /empresas
     *
     * @return Response
     */
    public function store() {

    }

    /**
     * Display the specified resource.
     * GET /empresas/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
       
    }

    /**
     * Show the form for editing the specified resource.
     * GET /empresas/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
//
    }

    /**
     * Update the specified resource in storage.
     * PUT /empresas/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
//
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /empresas/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
//
    }

    /**/

    public function importarClaro($id) {

        $data = Empresa::find($id);
        $claro = $data->Productos()->lists('name', 'id');
        array_unshift($claro, ' --- Seleccione un Prodcuto --- ');
        $mes = $this->Mes();
        return View::make('claros.importar', compact('claro', 'mes'));
    }

    /**
     * aqui ejecutamos todos los metodos para agregar un nuevo archivo o reemplazarlo
     */
    public function SaveClaro() {
        set_time_limit(0);
        ini_set('memory_limit', '10240M');
        /* de claramos las variables que recibimos por post */
        $mes = Input::get('mes');
        $year = Input::get('year');
        $producto = Input::get('productos_id');
        $file = Input::file('excel');
        $url = "files/claro/CICLO" . $producto . str_pad($mes, 2, '0', STR_PAD_LEFT) . $year . ".xlsx";


        /* agregamos un nuevo historial y retornamos el ID o buscamos regresamos el ID */
        $idHistorial = $this->SaveHistorials($mes, $year, $producto, $url);

        /* Corremos el archivo de excel y lo convertimos en un array */
        $excel = $this->uploadExcel($file, 'claro', 'CICLO' . $producto . str_pad($mes, 2, '0', STR_PAD_LEFT) . $year . '.xlsx');
        
        return  $this->saveExcel($excel, $idHistorial);

    }

    /**
     * @author Anwar Sarmiento
     * @param type $mes
     * @param type $year
     * @param type $producto
     * @return type
     * @description  Guardamos el historial de los productos 
     */
    private function SaveHistorials($mes, $year, $producto, $url) {
        /* Buscamos ver si ya existe el archivo que se quiere agregar */
        $verificacion = DB::table('historials')
                        ->where('mes', '=', $mes)
                        ->where('year', '=', $year)
                        ->where('productos_id', '=', $producto)->get();
        /* si existe enviamos el id */
        if ($verificacion):
            return $verificacion[0]->id;
        endif;
        /*  de lo contrario agregamos el nuevo historial */
        $Historial = new Historial;
        $Historial->mes = $mes;
        $Historial->year = $year;
        $Historial->productos_id = $producto;
        $Historial->url = $url;
        $Historial->save();
        /* Retornamos el id de la nueva fila */
        $id = Historial::all()->last();
        return $id->id;
    }

    private function saveExcel($data, $historial) {

        $datos = DatosEmpresa::where('historials_id', '=', $historial)->delete();
 

        foreach ($data AS $dataExcel):
            $datos_empresas = new DatosEmpresa;
            $datos_empresas->barra = '';
            $datos_empresas->codigo = $dataExcel['codigo'];
            $datos_empresas->tipo_cliente = $dataExcel['tipo_cliente'];
            $datos_empresas->telefono = $dataExcel['telefono'];
            $datos_empresas->name_cliente = $dataExcel['nombre_cliente'];
            $datos_empresas->comentario = $dataExcel['comentario'];
            $datos_empresas->fecha_entregado = $dataExcel['fecha_entrega'];
            $datos_empresas->fecha_recibido = $dataExcel['fecha_recibido'];
            $datos_empresas->monto = $dataExcel['monto'];
            $datos_empresas->direccion = $dataExcel['direccion'];
            $datos_empresas->comentario_ciudad = $dataExcel['comentario_ciudad'];
            $datos_empresas->ciudades_id = $this->convertionCiudad($dataExcel['ciudad']);
            $datos_empresas->historials_id = $historial;
            
            if(empty($dataExcel['observaciones'])):
                $datos_empresas->observaciones_id = 16;
            else:
                $datos_empresas->observaciones_id = $dataExcel['observaciones'];
            endif;
            if(empty($dataExcel['empleados'])):
                $datos_empresas->empleados_id =  null;
             else:
                $datos_empresas->empleados_id = $dataExcel['empleados'];
            endif;
            $datos_empresas->save();
        endforeach;
        return Redirect::to('claro/ciclo')->with('messege','se guardo con exito!!');
    }

    /**
     * 
     * @param type $file
     * @param string $path
     * @param type $fileName
     * @return boolean
     */
    private function uploadExcel($file, $path, $fileName) {

        $path = 'files/' . $path;

        if (strtoupper($file->getClientOriginalExtension()) == 'XLSX' || strtoupper($file->getClientOriginalExtension()) == 'XLS'):

            $file->move($path, $fileName);

            $files=  $path . '/' . $fileName;
               

         $excel=    Excel::load($files, function ($reader) {
                    // $reader->formatDates(true, 'Ym');
                    })->calculate()->toObject();
            return $excel;

        endif;

        return false;
    }
    public function ListaDatosEmpresas(){
         $datosEmpresas = DatosEmpresa::paginate();
        return View::make('claros.listaDatosEmpresas',compact('datosEmpresas'));
    }
    /**
    * Busca las ciudades por nombre y devuelve el id de la ciudad
    */
    private function convertionCiudad($ciudad) {
        $city = Ciudade::where('name', '=', $ciudad)->first();
        if ($city):
            return $city->id;
        endif;
        return false;
    }

    public function scanearCiclo() {
        $data =Input::all();
        
          $Producto = Historial::where('mes','=',$data['mes'])->where('year','=',$data['year'])->where('productos_id','=',$data['ciclo'])->get(); 
        if(($Producto)): 
              DB::update("UPDATE datos_empresas SET observaciones_id = 17 WHERE historials_id =  ".$Producto[0]->id."  AND codigo = ".$data['id']);
         
          if ($data['ciclo'] == 1):
              return Redirect::to('claros/scanearc46tv');
          elseif ($data['ciclo'] == 2):
              return Redirect::to('claros/scanearc46movil');
          elseif ($data['ciclo'] == 3):
              return Redirect::to('claros/scanearc48');
          endif;
        endif;
         if ($data['ciclo'] == 1):
              return Redirect::to('claros/scanearc46tv')->with('message','No se cambio el estado');
          elseif ($data['ciclo'] == 2):
              return Redirect::to('claros/scanearc46movil')->with('message','No se cambio el estado');
          elseif ($data['ciclo'] == 3):
              return Redirect::to('claros/scanearc48')->with('message','No se cambio el estado');
          endif;
        
        
      
      }

}
