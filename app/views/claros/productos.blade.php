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

		<div CLASS="titulo-bienvenido">Lista de Productos</div>
               
                <table>
                    <thead>
                    <th>Nº</th>
                    <th>Productos</th>
                    </thead>
                     @foreach($ciclos AS $datos)
                    <tbody>
                        <tr>
                    <td>{{$datos->id}}</td>
                    <td>{{$datos->name}}</td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>	
</div>
@stop