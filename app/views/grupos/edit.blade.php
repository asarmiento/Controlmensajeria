@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title>Grupos de Cuenta</title>
@stop
@section('title')
<h1 class="text-lowercase">Listas de Grupos de Cuentas</h1>
@stop
@section('container') 
<button onclick="location = '/grupos'"  class="btn btn-primary" type="button">
    Lista <span class="badge"></span>
</button>

<hr>
<div>
   
        {{ Form::open(array(
                'action'=>'GrupoController@postEdit',
                'method'=>'post',
                'role'=>'form',
                'class'=>'form-inline'
                ))}}
                @foreach($resultado as $data) 
        <div class="form-group">
            {{Form::label('Codigo:')}}       
            {{Form::text('codigo',$data->codigo)}}   
            {{$errors->first('codigo')}}
        </div>
        <div class="form-group">
            {{Form::label('Nombre:')}} 
            {{Form::text('nombre',$data->nombre)}} 
            {{Form::hidden('id',$data->id)}} 
            {{$errors->first('nombre')}}
        </div>
                @endforeach
        <div class="form-group">
            {{Form::submit('Cambiar',array('class'=>'btn btn-primary'))}} 
        </div>
        {{Form::close()}} 
    
</div>
@stop