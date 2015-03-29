<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClaroController
 *
 * @author Sistemas Amigables
 */
class ClaroController extends BaseController {

    //put your code here
    public function getIndex() {

        return View::make('claros.index');
    }
    public function importar(){
        return View::make('claros.importar');
    }

    public function getC48() {
        $data = DB::table('ciclos')->where('id', 7)->get();

        $paginacion = DB::table("datos_empresas")
                ->select('datos_empresas.id', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                ->where('empresas_id', 1)
                ->where('ciclo_id', 7)
                ->where('contador', ($data[0]->contador - 1))
                ->orderBy('name', 'ASC')
                ->paginate(50);

        $ciudad = array('all' => 'All');
        $drop = array('all' => 'All');
        $drop[] = DB::table('estados')->lists('name', 'id');
        $ciudad[] = DB::table('ciudades')->lists('name', 'id');
        return View::make('claros.c48', array('resultado' => $paginacion, 'estado' => $drop, 'ciudad' => $ciudad));
    }

    public function postC48() {
        $data = DB::table('ciclos')->where('id', 7)->get();
        if (isset($_POST['buscar'])) {
            $buscar = htmlspecialchars($_POST['buscar']);
            if ((Session::get('ciudad'))): $ciudad = Session::get('ciudad');
            else: $ciudad = "";
            endif;
            if ((Session::get('estado'))): $estado = Session::get('estado');
            else: $estado = "";
            endif;

            if (empty($estado) && empty($ciudad)):
                $paginacion = DB::table("datos_empresas")
                        ->select('datos_empresas.id', 'datos_empresas.tipo_cliente', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                        ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 7)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('name', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);

            elseif (($ciudad > 0) && empty($estado)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 7)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('ciudad_id', '=', $ciudad)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            elseif (empty($ciudad) && ($estado > 0)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 7)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('estado_id', '=', $estado)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            elseif (($ciudad > 0) && ($estado > 0)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 7)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('estado_id', '=', $estado)
                        ->where('ciudad_id', '=', $ciudad)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            else:
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 7)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            endif;
        } elseif (($_POST['ciudad'] == 'all') && ($_POST['estado'] == 'all')) {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 7)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['ciudad'] > 0) && ($_POST['estado'] == 'all')) {
            Session::put('ciudad', $_POST['ciudad']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 7)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('ciudad_id', $_POST['ciudad'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['ciudad'] == 'all') && ($_POST['estado'] > 0)) {
            Session::put('estado', $_POST['estado']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 7)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('estado_id', $_POST['estado'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['estado'] > 0) && ($_POST['ciudad'] > 0)) {
            Session::put('ciudad', $_POST['ciudad']);
            Session::put('estado', $_POST['estado']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 7)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('ciudad_id', $_POST['ciudad'])
                    ->where('estado_id', $_POST['estado'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->select('datos_empresas.id', 'datos_empresas.tipo_cliente', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                    ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 7)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('name', 'ASC')
                    ->paginate(50);
        }
        $ciudad = array('all' => 'All');
        $drop = array('all' => 'All');
        $drop[] = DB::table('estados')->lists('name', 'id');
        $ciudad[] = DB::table('ciudades')->lists('name', 'id');
        return View::make('claros.c48', array('resultado' => $paginacion, 'estado' => $drop, 'ciudad' => $ciudad));
    }

    public function getC46tv() {
        $data = DB::table('ciclos')->where('id', 1)->get();

        $paginacion = DB::table("datos_empresas")
                ->select('datos_empresas.id', 'datos_empresas.tipo_cliente', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                ->where('empresas_id', 1)
                ->where('ciclo_id', 1)
                ->where('contador', ($data[0]->contador - 1))
                ->orderBy('name', 'ASC')
                ->paginate(50);

        $ciudad = array('all' => 'All');
        $drop = array('all' => 'All');
        $drop[] = DB::table('estados')->lists('name', 'id');
        $ciudad[] = DB::table('ciudades')->lists('name', 'id');
        return View::make('claros.c46tv', array('resultado' => $paginacion, 'estado' => $drop, 'ciudad' => $ciudad));
    }

    public function postC46tv() {
        $data = DB::table('ciclos')->where('id', 1)->get();
        if (isset($_POST['buscar'])) {
            $buscar = htmlspecialchars($_POST['buscar']);
            if ((Session::get('ciudad'))): $ciudad = Session::get('ciudad');
            else: $ciudad = "";
            endif;
            if ((Session::get('estado'))): $estado = Session::get('estado');
            else: $estado = "";
            endif;

            if (empty($estado) && empty($ciudad)):
                $paginacion = DB::table("datos_empresas")
                        ->select('datos_empresas.id', 'datos_empresas.tipo_cliente', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                        ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 1)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('name', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);

            elseif (($ciudad > 0) && empty($estado)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 1)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('ciudad_id', '=', $ciudad)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            elseif (empty($ciudad) && ($estado > 0)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 1)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('estado_id', '=', $estado)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            elseif (($ciudad > 0) && ($estado > 0)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 1)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('estado_id', '=', $estado)
                        ->where('ciudad_id', '=', $ciudad)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            else:
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 1)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            endif;
        } elseif (($_POST['ciudad'] == 'all') && ($_POST['estado'] == 'all')) {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 1)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['ciudad'] > 0) && ($_POST['estado'] == 'all')) {
            Session::put('ciudad', $_POST['ciudad']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 1)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('ciudad_id', $_POST['ciudad'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['ciudad'] == 'all') && ($_POST['estado'] > 0)) {
            Session::put('estado', $_POST['estado']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 1)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('estado_id', $_POST['estado'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['estado'] > 0) && ($_POST['ciudad'] > 0)) {
            Session::put('ciudad', $_POST['ciudad']);
            Session::put('estado', $_POST['estado']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 1)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('ciudad_id', $_POST['ciudad'])
                    ->where('estado_id', $_POST['estado'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->select('datos_empresas.id', 'datos_empresas.tipo_cliente', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                    ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 1)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('name', 'ASC')
                    ->paginate(50);
        }
        $ciudad = array('all' => 'All');
        $drop = array('all' => 'All');
        $drop[] = DB::table('estados')->lists('name', 'id');
        $ciudad[] = DB::table('ciudades')->lists('name', 'id');
        return View::make('claros.c46tv', array('resultado' => $paginacion, 'estado' => $drop, 'ciudad' => $ciudad));
    }

    public function getC46movil() {
        $data = DB::table('ciclos')->where('id', 6)->get();
        if ((Session::get('ciudad'))): $ciudad = Session::get('ciudad');
        else: $ciudad = "";
        endif;
        if ((Session::get('estado'))): $estado = Session::get('estado');
        else: $estado = "";
        endif;
        if ($ciudad > 0 && $estado > 0):
            $paginacion = DB::table("datos_empresas")
                    ->select('datos_empresas.id', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.tipo_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                    ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 6)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('estado_id', '=', $estado)
                    ->where('ciudad_id', '=', $ciudad)
                    ->orderBy('name', 'ASC')
                    ->paginate(50);
        else:
            $paginacion = DB::table("datos_empresas")
                    ->select('datos_empresas.id', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.tipo_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                    ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 6)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('name', 'ASC')
                    ->paginate(50);
        endif;
        $ciudad = array('all' => 'All');
        $drop = array('all' => 'All');
        $drop[] = DB::table('estados')->lists('name', 'id');
        $ciudad[] = DB::table('ciudades')->lists('name', 'id');
        return View::make('claros.c46movil', array('resultado' => $paginacion, 'estado' => $drop, 'ciudad' => $ciudad));
    }

    public function postC46movil() {
        $data = DB::table('ciclos')->where('id', 6)->get();

        if (isset($_POST['buscar'])) {
            $buscar = htmlspecialchars($_POST['buscar']);
            if ((Session::get('ciudad'))): $ciudad = Session::get('ciudad');
            else: $ciudad = "";
            endif;
            if ((Session::get('estado'))): $estado = Session::get('estado');
            else: $estado = "";
            endif;

            if (($estado == 'all') && ($ciudad == 'all')):
                $paginacion = DB::table("datos_empresas")
                        ->select('datos_empresas.id', 'datos_empresas.tipo_cliente', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                        ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 6)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('name', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);

            elseif (($ciudad > 0) && empty($estado)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 6)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('ciudad_id', '=', $ciudad)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            elseif (empty($ciudad) && ($estado > 0)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 6)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('estado_id', '=', $estado)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            elseif (($ciudad > 0) && ($estado > 0)):
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 6)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('estado_id', '=', $estado)
                        ->where('ciudad_id', '=', $ciudad)
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);
            else:
                $paginacion = DB::table("datos_empresas")
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 6)
                        ->where('contador', ($data[0]->contador - 1))
                        ->where('name_cliente', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('codigo', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('monto', 'LIKE', '%' . $buscar . '%')
                        ->orwhere('fecha_entregado', 'LIKE', '%' . $buscar . '%')
                        ->orderBy('id', 'DESC')
                        ->paginate(50);

            endif;
        }

        elseif (($_POST['ciudad'] == 'all') && ($_POST['estado'] == 'all')) {
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 6)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['ciudad'] > 0) && ($_POST['estado'] == 'all')) {
            Session::put('ciudad', $_POST['ciudad']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', '=', 1)
                    ->where('ciclo_id', '=', 6)
                    ->where('contador', '=', ($data[0]->contador - 1))
                    ->where('ciudad_id', '=', (int) Session::get('ciudad'))
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['ciudad'] == 'all') && ($_POST['estado'] > 0)) {
            Session::put('estado', $_POST['estado']);
            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 6)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('estado_id', $_POST['estado'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } elseif (($_POST['estado'] > 0) && ($_POST['ciudad'] > 0)) {
            Session::put('ciudad', $_POST['ciudad']);
            Session::put('estado', $_POST['estado']);

            $paginacion = DB::table("datos_empresas")
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 6)
                    ->where('contador', ($data[0]->contador - 1))
                    ->where('ciudad_id', $_POST['ciudad'])
                    ->where('estado_id', $_POST['estado'])
                    ->orderBy('id', 'DESC')
                    ->paginate(50);
        } else {
            $paginacion = DB::table("datos_empresas")
                    ->select('datos_empresas.id', 'datos_empresas.tipo_cliente', 'datos_empresas.codigo', 'datos_empresas.name_cliente', 'datos_empresas.estado_id', 'datos_empresas.empresas_id', 'datos_empresas.observacion_id', 'datos_empresas.comentario', 'datos_empresas.mensajero_id', 'datos_empresas.ciudad_id')
                    ->join('ciudades', 'ciudades.id', '=', 'datos_empresas.ciudad_id')
                    ->where('empresas_id', 1)
                    ->where('ciclo_id', 6)
                    ->where('contador', ($data[0]->contador - 1))
                    ->orderBy('name', 'ASC')
                    ->paginate(50);
        }
        $ciudad = array('all' => 'All');
        $drop = array('all' => 'All');
        $drop[] = DB::table('estados')->lists('name', 'id');
        $ciudad[] = DB::table('ciudades')->lists('name', 'id');
        return View::make('claros.c46movil', array('resultado' => $paginacion, 'estado' => $drop, 'ciudad' => $ciudad));
    }

    public function getImportar() {
        $data = DB::table('ciclos')->where('empresas_id', 1)->lists('name', 'id');

        return View::make('claros.importar', array('drop' => $data));
    }

    public function postImportar() {
        $input = Input::all();
        $ciclo = $_POST['ciclo'];
        Excel::load($input['importar'], function($archivo) {
            $result = $archivo->get();
            $data = DB::table('ciclos')->where('id', $_POST['ciclo'])->get();
            foreach ($result As $value): //dd($value);
                $ciudad = DB::table('ciudades')->where('name', $value['ciudad'])->get();
                DB::insert('insert into datos_empresas ( estado_id,empresas_id,usuario_id,mes,year,ciclo_id,codigo,name_cliente,tipo_cliente,phone,ciudad_id,contador) values (?,?,?,?,?,?,?,?,?,?,?,?)', array(4, 1, Auth::user()->id, $_POST['mes'], date('Y'), $_POST['ciclo'], $value['codigo'], $value['nombre'], $value['tipo'], $value['telefono'], $ciudad[0]->id, $data[0]->contador));
            endforeach;
        });
        $input = Input::all();
        $data = DB::table('ciclos')->where('id', $ciclo)->get();
        $contador = $data[0]->contador + 1;
        DB::update("UPDATE ciclos SET contador = $contador WHERE id= " . $input['ciclo']);

        if ($ciclo == 6):
            return Redirect::to('claros/c46movil');
        elseif ($ciclo == 1):
            return Redirect::to('claros/c46tv');
        elseif ($ciclo == 7):
            return Redirect::to('claros/c48');

        endif;
    }

    public function getDelete() {
        DB::table('datos_empresas')
                ->where('ciclo_id', $_GET['id'])
                ->where('empresas_id', $_GET['empresa'])
                ->where('contador', $_GET['contador'])->delete();
        return Redirect::to('claros/historial');
    }

    public function getBarrido() {
        $data = DB::table('estados')->lists('name', 'id');
        $ciclo = DB::table('ciclos')->where('empresas_id', 1)->lists('name', 'id');
        $ciudad = DB::table('ciudades')->lists('name', 'id');
        return View::make('claros.barrido', array('drop' => $data, 'ciclo' => $ciclo, 'ciudad' => $ciudad));
    }

    public function postBarrido() {
        $input = Input::all();
        if ($input['observEnt'] > 0):
            $observacion = $input['observEnt'];
        elseif ($input['observDev'] > 0):
            $observacion = $input['observDev'];
        else:
            $observacion = "";
        endif;
        DB::update("UPDATE datos_empresas SET estado_id = '" . $input['estadodespues'] . "',  observacion_id = '" . $observacion . "' "
                . "WHERE estado_id = '" . $input['estadoantes'] . "' AND ciclo_id = '" . $input['ciclo'] . "' AND ciudad_id = '" . $input['ciudad'] . "'  AND mes = '" . $input['mes'] . "' AND year = '" . $input['year'] . "' ");
        return Redirect::to('claros/barrido');
    }

    public function postBarridoall() {
        $input = Input::all();
        DB::update("UPDATE datos_empresas SET estado_id = '" . $input['estadodespues'] . "' "
                . "WHERE estado_id = '" . $input['estadoantes'] . "' AND ciclo_id = '" . $input['ciclo'] . "' AND mes = '" . $input['mes'] . "' AND year = '" . $input['year'] . "'  ");
        return Redirect::to('claros/barrido');
    }

    public function getScanearmala() {
        return View::make('claros.scanearmala');
    }

    public function getScanearcambio() {
        return View::make('claros.scanearcambio');
    }

    public function getHistorial() {
        $ciclo = DB::table('ciclos')->where('empresas_id', 1)->get();
        return View::make('claros.historial', array('ciclos' => $ciclo));
    }

    public function getScanearcentro() {
        return View::make('claros.scanearcentro');
    }

    public function getProductos() {
        $ciclo = DB::table('ciclos')->where('empresas_id', 1)->get();
        return View::make('claros.productos', array('ciclos' => $ciclo));
    }

    public function postScaneardevolucion() {
        $input = Input::all();
        if ($input['campo'] == 'estado'):
            DB::update("UPDATE datos_empresas SET estado_id = '" . $input['ciclo'] . "', observacion_id = '" . $input['observacion'] . "'  "
                    . "WHERE codigo = '" . $input['id'] . "' ");
        endif;


        $input = Input::all();
        if ($input['observacion'] == 7):
            return Redirect::to('claros/scanearmala');
        elseif ($input['observacion'] == 9):
            return Redirect::to('claros/scanearcambio');
        elseif ($input['observacion'] == 10):
            return Redirect::to('claros/scanearcentro');
        endif;
    }

    public function getScanearc48() {
        $mes = $this->Mes();
        return View::make('claros.scanearc48',  compact('mes'));
    }

    public function getScanearc46tv() {
         $mes = $this->Mes();
        return View::make('claros.scanearc46tv',  compact('mes'));
    }

    public function getScanearc46movil() {
         $mes = $this->Mes();
        return View::make('claros.scanearc46movil',  compact('mes'));
    }

    public function postScanearciclo() {
        $input = Input::all();
        $contador = DB::table('ciclos')->where('id', $input['ciclo'])->get();
        DB::update("UPDATE datos_empresas SET estado_id = 1 WHERE codigo = '" . $input['id'] . "' AND contador = '" . ($contador[0]->contador - 1) . "'");
        $input = Input::all();
        if ($input['ciclo'] == 1):
            return Redirect::to('claros/scanearc46tv');
        elseif ($input['ciclo'] == 6):
            return Redirect::to('claros/scanearc46movil');
        elseif ($input['ciclo'] == 7):
            return Redirect::to('claros/scanearc48');
        endif;
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
        $pdf->Cell(7, 10, 'N�', 1, 0, 'C');
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

    public function getExcelc46movil() {
        Excel::create('ReportedeEntrega', function($excel) {
            $excel->sheet('Reporte', function($sheet) {
                $sheet->setPageMargin(0.5);
                $sheet->setBorder('A7:H7', 'thin');
                $sheet->mergeCells('A1:H1');
                $sheet->cells('A1:H1', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('center');
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                    $cells->setValignment('middle');
                });
                $sheet->cells('D1:H1', function($cells) {
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
                $sheet->cells('A7:H7', function($cells) {
                    $cells->setbackground('#18375b');
                    $cells->setFontColor('#ffffff');
                });
                $data = [];
                array_push($data, array('Reporte de Entrega', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', 'Cliente: ', 'Claro', '', 'Fecha:' . date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: '), 'Ciclo C-46 Movil', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Codigo', 'Nombre', 'Tipo Cliente', 'Estado', 'Observacion', 'Comentario', 'Mensajero', 'Ciudad'));
                $contador = DB::table('ciclos')->where('id', 6)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 6)
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
                    $ciudad = Ciudade::find($variable->ciudad_id);
                    if ($ciudad == NULL): $ciudades = '';
                    else: $ciudades = $ciudad['name'];
                    endif;
                    $observacion = Observacione::find($variable->observacion_id);
                    if ($observacion == NULL): $observaciones = '';
                    else: $observaciones = $observacion['name'];
                    endif;
                    array_push($data, array($i, $variable->codigo, $variable->name_cliente, $variable->tipo_cliente, $estados, $observaciones, $variable->comentario, $mensajeros, $ciudades));
                endforeach;

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }

    public function getPdfc46tv() {
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('l', 'letter');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(130, 10, 'Cliente: Claro', 0, 0, 'L');
        $pdf->Cell(40, 10, 'Fecha: ' . date('d-m-Y'), 0, 1, 'L');
        $pdf->Cell(10, 10, 'Producto: Ciclo C-46 TV', 0, 1, 'L');
        $pdf->SetX(5);
        $pdf->Cell(7, 10, 'N�', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Codigo', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Nombre', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Tipo Cliente', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Estado', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Observaci�n', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Comentario', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Mensajero', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Ciudad', 1, 1, 'C');
        $contador = DB::table('ciclos')->where('id', 1)->get();
        $datos = DB::table('datos_empresas')
                ->where('empresas_id', 1)
                ->where('ciclo_id', 1)
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

    public function getExcelc46tv() {
        Excel::create('ReportedeEntrega', function($excel) {
            $excel->sheet('Reporte', function($sheet) {
                $sheet->setPageMargin(0.5);
                $sheet->setBorder('A7:H7', 'thin');
                $sheet->mergeCells('A1:H1');
                $sheet->cells('A1:H1', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('center');
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                    $cells->setValignment('middle');
                });
                $sheet->cells('D1:H1', function($cells) {
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
                $sheet->cells('A7:H7', function($cells) {
                    $cells->setbackground('#18375b');
                    $cells->setFontColor('#ffffff');
                });
                $data = [];
                array_push($data, array('Reporte de Entrega', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', 'Cliente: ', 'Claro', '', 'Fecha:' . date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: '), 'Ciclo C-46 TV', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Codigo', 'Nombre', 'Tipo Cliente', 'Estado', 'Observacion', 'Comentario', 'Mensajero', 'Ciudad'));
                $contador = DB::table('ciclos')->where('id', 1)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 1)
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
                    $ciudad = Ciudade::find($variable->ciudad_id);
                    if ($ciudad == NULL): $ciudades = '';
                    else: $ciudades = $ciudad['name'];
                    endif;
                    $observacion = Observacione::find($variable->observacion_id);
                    if ($observacion == NULL): $observaciones = '';
                    else: $observaciones = $observacion['name'];
                    endif;
                    array_push($data, array($i, $variable->codigo, $variable->name_cliente, $variable->tipo_cliente, $estados, $observaciones, $variable->comentario, $mensajeros, $ciudades));
                endforeach;

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }

    public function getPdfc48() {
        // Instanciation of inherited class
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('l', 'letter');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(130, 10, 'Cliente: Claro', 0, 0, 'L');
        $pdf->Cell(40, 10, 'Fecha: ' . date('d-m-Y'), 0, 1, 'L');
        $pdf->Cell(10, 10, 'Producto: Ciclo C-48', 0, 1, 'L');
        $pdf->SetX(5);
        $pdf->Cell(7, 10, 'N�', 1, 0, 'C');
        $pdf->Cell(15, 10, 'Codigo', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Nombre', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Tipo Cliente', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Estado', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Observaci�n', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Comentario', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Mensajero', 1, 0, 'C');
        $pdf->Cell(35, 10, 'Ciudad', 1, 1, 'C');
        $contador = DB::table('ciclos')->where('id', 7)->get();
        $datos = DB::table('datos_empresas')
                ->where('empresas_id', 1)
                ->where('ciclo_id', 7)
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

    public function getExcelc48() {
        Excel::create('ReportedeEntrega', function($excel) {
            $excel->sheet('Reporte', function($sheet) {
                $sheet->setPageMargin(0.5);
                $sheet->setBorder('A7:H7', 'thin');
                $sheet->mergeCells('A1:H1');
                $sheet->cells('A1:H1', function($cells) {
                    $cells->setbackground('#e4e4e4');
                    $cells->setAlignment('center');
                    $cells->setFontSize(19);
                    $cells->setFontWeight('bold');
                    $cells->setValignment('middle');
                });
                $sheet->cells('D1:H1', function($cells) {
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
                $sheet->cells('A7:H7', function($cells) {
                    $cells->setbackground('#18375b');
                    $cells->setFontColor('#ffffff');
                });
                $data = [];
                array_push($data, array('Reporte de Entrega', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('', 'Cliente: ', 'Claro', '', 'Fecha:' . date('d-m-Y'), '', ''));
                array_push($data, array('', utf8_decode('Producto: '), 'Ciclo C-48', '', '', '', ''));
                array_push($data, array('', '', '', '', '', '', ''));
                array_push($data, array('Nº', 'Codigo', 'Nombre', 'Tipo Cliente', 'Estado', 'Observacion', 'Comentario', 'Mensajero', 'Ciudad'));
                $contador = DB::table('ciclos')->where('id', 7)->get();
                $datos = DB::table('datos_empresas')
                        ->where('empresas_id', 1)
                        ->where('ciclo_id', 7)
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
                    $ciudad = Ciudade::find($variable->ciudad_id);
                    if ($ciudad == NULL): $ciudades = '';
                    else: $ciudades = $ciudad['name'];
                    endif;
                    $observacion = Observacione::find($variable->observacion_id);
                    if ($observacion == NULL): $observaciones = '';
                    else: $observaciones = $observacion['name'];
                    endif;
                    array_push($data, array($i, $variable->codigo, $variable->name_cliente, $variable->tipo_cliente, $estados, $observaciones, $variable->comentario, $mensajeros, $ciudades));
                endforeach;

                $sheet->fromArray($data, null, 'A1', false, false);
            });
        })->export('xlsx');
    }

}
