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
     * 
     * @param type $file
     * @param string $path
     * @param type $fileName
     * @return boolean
     * 
     */
    public static function uploadExcel($file, $path, $fileName) {

        $path = 'files/' . $path;
        if (strtoupper($file->getClientOriginalExtension()) == 'XLSX' || strtoupper($file->getClientOriginalExtension()) == 'XLS'):
            $file->move($path, $fileName);
            $files = $path . '/' . $fileName;
            $excel = Excel::load($files, function ($reader) {
                        $reader->formatDates(true, 'Y-m-d');
                    })->all();

            return $excel;
        endif;
        return false;
    }

    public function scanearCiclo() {
        $data = Input::all();

        $Producto = Historial::where('mes', '=', $data['mes'])->where('year', '=', $data['year'])->where('productos_id', '=', $data['ciclo'])->get();
        if (($Producto)):
            DB::update("UPDATE datos_empresas SET observaciones_id = 17 WHERE historials_id =  " . $Producto[0]->id . "  AND codigo = " . $data['id']);

            if ($data['ciclo'] == 1):
                return Redirect::to('claros/scanearc46tv');
            elseif ($data['ciclo'] == 2):
                return Redirect::to('claros/scanearc46movil');
            elseif ($data['ciclo'] == 3):
                return Redirect::to('claros/scanearc48');
            endif;
        endif;
        if ($data['ciclo'] == 1):
            return Redirect::to('claros/scanearc46tv')->with('message', 'No se cambio el estado');
        elseif ($data['ciclo'] == 2):
            return Redirect::to('claros/scanearc46movil')->with('message', 'No se cambio el estado');
        elseif ($data['ciclo'] == 3):
            return Redirect::to('claros/scanearc48')->with('message', 'No se cambio el estado');
        endif;
    }

}
