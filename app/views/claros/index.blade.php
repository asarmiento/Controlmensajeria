	@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Sistemas Amigables">
<meta name="keyword" content="palabras, clave">     
<title>Estado Cuenta</title>

@stop

@section('title')
<h1 class="text-lowercase"></h1>
@stop

@section('container') 
     
<center><h2><span class="glyphicon glyphicon-list-alt"><br>Administración Claro <img src="http://sistema.elcorso.hn/asset/img/logosclientes/logo-claro.png"></span></h2></center>
<hr>
@if(Auth::user()->type_users_id=="1")
<h3><span class="glyphicon glyphicon-list-alt"><br>Ciclos</span></h3>
<div class="btn btn-danger"><a href="{{route('importar-ciclo',1)}}">Subir Ciclo</a></a></div>
<div class="btn btn-danger"><a href="claros/productos">Productos</a></a></div>
<div class="btn btn-danger"><a href="claros/agregar">Agregar Personas al Ciclo</a></a></div>
<div class="btn btn-danger"><a href="{{route('historial-productos',1)}}">Historial de Ciclo</a></div>
<hr>
<h3><span class="glyphicon glyphicon-list-alt"><br>Scanear</span></h3>
<div class="btn btn-danger"><a href="claros/scanearc48">Scanear Sobres <br>de Ciclo C-48</a></div>
<div class="btn btn-danger"><a href="claros/scanearc46tv">Scanear Sobres <br>de Ciclo C-46 TV</a></div>
<div class="btn btn-danger"><a href="claros/scanearc46movil">Scanear Sobres <br>de Ciclo C-46 Movil</a></div>
<div class="btn btn-danger"><a href="claros/scanearmala">Scanear Devolución<br>por mala dirección</a></div>
<div class="btn btn-danger"><a href="claros/scanearcambio">Scanear Devolución<br>por Cambio de dirección</a></div>
<div class="btn btn-danger"><a href="claros/scanearcentro">Scanear Devolución<br>por Cambio de centro de Trabajo</a></div>
<hr>
<h3><span class="glyphicon glyphicon-list-alt"><br>Otras funciones</span></h3>
<div class="btn btn-danger"><a href="claros/barrido">Barrido</a></div>
@endif
@if(Auth::user()->type_users_id=="2")

<h3><span class="glyphicon glyphicon-list-alt"><br>Scanear</span></h3>
<div class="btn btn-danger"><a href="claros/scanearc48">Scanear Sobres <br>de Ciclo C-48</a></div>
<div class="btn btn-danger"><a href="claros/scanearc46tv">Scanear Sobres <br>de Ciclo C-46 TV</a></div>
<div class="btn btn-danger"><a href="claros/scanearc46movil">Scanear Sobres <br>de Ciclo C-46 Movil</a></div>
<div class="btn btn-danger"><a href="claros/scanearmala">Scanear Devolución<br>por mala dirección</a></div>
<div class="btn btn-danger"><a href="claros/scanearcambio">Scanear Devolución<br>por Cambio de dirección</a></div>
<div class="btn btn-danger"><a href="claros/scanearcentro">Scanear Devolución<br>por Cambio de centro de Trabajo</a></div>

@endif
@stop
