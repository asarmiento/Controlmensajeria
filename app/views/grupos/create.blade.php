@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title>Grupos de Cuenta</title>
@stop
@section('title')
<h1 class="text-lowercase">Agregar nuevo Grupo de Cuentas</h1>
@stop
@section('container') 
<button onclick="location = '/grupos'"  class="btn btn-primary" type="button">
    Lista <span class="badge"></span>
</button>

<hr>
<div>
    @if(isset($datos))
    <div class="text text-info "><span class="glyphicon glyphicon-ok"></span> Se Guardo con exito el Codigo: <strong> {{$datos['codigo']}}</strong> Con nombre: <strong>{{$datos['nombre']}}</strong></div>
    @else
        {{ Form::open(array(
                'action'=>'GrupoController@postCreate',
                'method'=>'post',
                'role'=>'form',
                'class'=>'form-inline'
                ))}}
        <div class="form-group">
            {{Form::label('Codigo:')}}       
            {{Form::text('codigo')}}   
            {{$errors->first('codigo')}}
        </div>
        <div class="form-group">
            {{Form::label('Nombre:')}} 
            {{Form::text('nombre')}} 
            {{$errors->first('nombre')}}
        </div>
        <div class="form-group">
            {{Form::submit('Guardar',array('class'=>'btn btn-primary'))}} 
        </div>
        {{Form::close()}} 
   @endif     
</div>
@stop