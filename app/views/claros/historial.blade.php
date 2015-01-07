@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title>Escanear</title>
<script type="text/javascript">
    $(document).ready(function(){ $('#newestado').focus();});
</script>
@stop
@section('container') 
<div class="menu-inicio">

		<div CLASS="titulo-bienvenido">Historial de Ciclos <img src="http://sistema.elcorso.hn/asset/img/logosclientes/logo-claro.png"></div>
 <table class="table table-striped">
                    <thead>
                    <th>Nombre Ciclo</th>
                    <th>Mes</th>
                    <th>Year</th>
                    <th>Cantidad Filas</th>
                    <th>En Ruta</th>
                    <th>Entregado</th>
                    <th>Devolucion</th>
                    <th>No Entregado</th>
                    <th>Eliminar</th>
                    </thead>
                     @foreach($ciclos AS $datos)
                     <?php  
                     $data = DB::table('datos_empresas')->where('ciclo_id',$datos->id)->groupby('ciclo_id')->get(); 
                     $datas = DB::table('datos_empresas')->where('ciclo_id',$datos->id)->count(); 
                      $ruta = DB::table('datos_empresas')->where('ciclo_id',$datos->id)->where('estado_id',1)->count();
                      $entregado = DB::table('datos_empresas')->where('ciclo_id',$datos->id)->where('estado_id',2)->count();
                      $devolucion = DB::table('datos_empresas')->where('ciclo_id',$datos->id)->where('estado_id',3)->count();
                      $noentregado = DB::table('datos_empresas')->where('ciclo_id',$datos->id)->where('estado_id',4)->count();
                     if($data):
                     ?>
                    <tbody>
                        <tr>
                    <td>{{$datos->name}}</td>
                    <td>{{$data[0]->mes}}</td>
                    <td>{{$data[0]->year}}</td>
                    <td>{{$datas}}</td>
                    <td>{{$ruta}}</td>
                    <td>{{$entregado}}</td>
                    <td>{{$devolucion}}</td>
                    <td>{{$noentregado}}</td>
                    <td><a class="btn btn-danger" href="delete?id=<?php echo $data[0]->ciclo_id; ?>&empresa=<?php echo $datos->empresas_id ?>&contador=<?php echo $data[0]->contador ?>">
                            <span class="glyphicon glyphicon-remove-circle"></span></a></td>
                    </tr>
                    </tbody>
                    <?php endif; ?>
                    @endforeach
                </table>	
</div>
@stop