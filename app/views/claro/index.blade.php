@extends('template.base')
@section('head')
	<meta name="description" content="Administración de Claro">
	<meta name="author" content="Sistemas Amigables">
	<title>Administración Claro</title>
@stop
@section('content') 
	<center>
		<h2>
                    <span class="glyphicon glyphicon-list-alt"></span>Administración Claro <img src="{{asset('img/logo-claro.png')}}">
		</h2>
	</center>
	<hr>
	@yield('data_products')
	@if(Auth::user()->type_users_id=="1")
		<h3><span class="glyphicon glyphicon-list-alt"></span>Ciclos</h3>
		<a class="btn btn-danger"href="{{route('importar-ciclo',1)}}">Subir Ciclo</a>
		<a class="btn btn-danger"href="">Productos</a>
		<a class="btn btn-danger"href="">Agregar Personas al Ciclo</a>
		<a class="btn btn-danger"href="{{route('historial-productos',1)}}">Historial de Ciclo</a>
		<hr>
		<h3><span class="glyphicon glyphicon-list-alt"></span>Scanear</h3>
		<a class="btn btn-danger"href="">Scanear Sobres <br>de Ciclo C-48</a>
		<a class="btn btn-danger"href="">Scanear Sobres <br>de Ciclo C-46 TV</a>
		<a class="btn btn-danger"href="">Scanear Sobres <br>de Ciclo C-46 Movil</a>
		<a class="btn btn-danger"href="">Scanear Devolución<br>por mala dirección</a>
		<a class="btn btn-danger"href="">Scanear Devolución<br>por Cambio de dirección</a>
		<a class="btn btn-danger"href="">Scanear Devolución<br>por Cambio de centro de Trabajo</a>
		<hr>
		<h3><span class="glyphicon glyphicon-list-alt"></span>Otras funciones</h3>
		<a class="btn btn-danger"href="">Barrido</a>
	@endif
	@if(Auth::user()->type_users_id=="4")
		<h3><span class="glyphicon glyphicon-list-alt"></span>Ciclos</h3>
		<a class="btn btn-danger"href="">Subir Ciclo</a>
		<a class="btn btn-danger"href="">Productos</a>
		<a class="btn btn-danger"href="">Agregar Personas al Ciclo</a>
		<a class="btn btn-danger"href="">Historial de Ciclo</a>
		<hr>
		<h3><span class="glyphicon glyphicon-list-alt"></span>Scanear</h3>
		<a class="btn btn-danger"href="">Scanear Sobres <br>de Ciclo C-48</a>
		<a class="btn btn-danger"href="">Scanear Sobres <br>de Ciclo C-46 TV</a>
		<a class="btn btn-danger"href="">Scanear Sobres <br>de Ciclo C-46 Movil</a>
		<a class="btn btn-danger"href="">Scanear Devolución<br>por mala dirección</a>
		<a class="btn btn-danger"href="">Scanear Devolución<br>por Cambio de dirección</a>
		<a class="btn btn-danger"href="">Scanear Devolución<br>por Cambio de centro de Trabajo</a>
		<hr>
		<h3><span class="glyphicon glyphicon-list-alt"></span>Otras funciones</h3>
		<a class="btn btn-danger"href="">Barrido</a>
	@endif
@stop