@extends('template.base')

@section('content')
	<h3 class="text-center">Bienvenido {{ Auth::user()->nombre_completo() }}</h3>
@stop