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
                    <th>Nombre Producto</th>
                    <th>Mes</th>
                    <th>Year</th>
                    <th>Cantidad Filas</th>
                    <th>En Ruta</th>
                    <th>Entregado</th>
                    <th>Devolucion</th>
                    <th>No Entregado</th>
                    <th>Eliminar</th>
                    </thead>
                     @foreach($historial AS $datos)
                     
                    <tbody>
                        <tr>
                    <td>{{$datos->productos->name}}</td>
                    <td>{{$datos->mes}}</td>
                    <td>{{$datos->year}}</td>
                    <td>{{$datos->datosEmpresas->count()}}</td>
                    <td>{{$datos->productos->observaciones->estados->count()}}</td>
                    <td>{{$datos}}</td>
                    <td>{{$datos}}</td>
                    <td>{{$datos}}</td>
                    <td><a class="btn btn-danger" href="#">
                            <span class="glyphicon glyphicon-remove-circle"></span></a></td>
                    </tr>
                    </tbody>
                   
                    @endforeach
                </table>	
</div>
@stop