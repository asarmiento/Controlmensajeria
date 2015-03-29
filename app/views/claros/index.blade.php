@extends('template.base')

@section('head')
	<meta name="description" content="Estado de Cuenta">
	<meta name="author" content="Sistemas Amigables">
	<title>Estado Cuenta</title>
@stop

@section('content') 
	<center>
		<h2>
			<span class="glyphicon glyphicon-list-alt"></span>Administración Claro <img src="{{asset('img/logo-claro.png')}}">
		</h2>
	</center>
	<hr>
	@if(Auth::user()->type_users_id=="1")
		<h3><span class="glyphicon glyphicon-list-alt"></span>Ciclos</h3>
		<a class="btn btn-danger"href="{{route('importar-ciclo',1)}}">Subir Ciclo</a>
		<a class="btn btn-danger"href="claros/productos">Productos</a>
		<a class="btn btn-danger"href="claros/agregar">Agregar Personas al Ciclo</a>
		<a class="btn btn-danger"href="{{route('historial-productos',1)}}">Historial de Ciclo</a>
		<hr>
		<h3><span class="glyphicon glyphicon-list-alt"></span>Scanear</h3>
		<a class="btn btn-danger"href="claros/scanearc48">Scanear Sobres <br>de Ciclo C-48</a>
		<a class="btn btn-danger"href="claros/scanearc46tv">Scanear Sobres <br>de Ciclo C-46 TV</a>
		<a class="btn btn-danger"href="claros/scanearc46movil">Scanear Sobres <br>de Ciclo C-46 Movil</a>
		<a class="btn btn-danger"href="claros/scanearmala">Scanear Devolución<br>por mala dirección</a>
		<a class="btn btn-danger"href="claros/scanearcambio">Scanear Devolución<br>por Cambio de dirección</a>
		<a class="btn btn-danger"href="claros/scanearcentro">Scanear Devolución<br>por Cambio de centro de Trabajo</a>
		<hr>
		<h3><span class="glyphicon glyphicon-list-alt"></span>Otras funciones</h3>
		<a class="btn btn-danger"href="claros/barrido">Barrido</a>
	@endif
	@if(Auth::user()->type_users_id=="2")
		<h3><span class="glyphicon glyphicon-list-alt"></span>Scanear</h3>
		<a class="btn btn-danger"href="claros/scanearc48">Scanear Sobres <br>de Ciclo C-48</a>
		<a class="btn btn-danger"href="claros/scanearc46tv">Scanear Sobres <br>de Ciclo C-46 TV</a>
		<a class="btn btn-danger"href="claros/scanearc46movil">Scanear Sobres <br>de Ciclo C-46 Movil</a>
		<a class="btn btn-danger"href="claros/scanearmala">Scanear Devolución<br>por mala dirección</a>
		<a class="btn btn-danger"href="claros/scanearcambio">Scanear Devolución<br>por Cambio de dirección</a>
		<a class="btn btn-danger"href="claros/scanearcentro">Scanear Devolución<br>por Cambio de centro de Trabajo</a>
	@endif
@stop
