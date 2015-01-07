@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title></title>
@stop
@section('title')
<h1 class="text-lowercase">Banco Atlantida - Agregar Tarjeta de Crédito</h1>
@stop
@section('container') 

<center><h2><span class="glyphicon glyphicon-list-alt"><br>Agregar Tarjeta de Crédito "Banco Atlántida"</span></h2></center>
<hr>


<button onclick="location = 'index'"  class="btn btn-primary" type="button">
    Ver Lista Completa <span class="badge"></span>
</button>

<div class="right">
{{ Form::open(array(
            'action'=>'AtlantidadController@getCreate',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}
            {{Form::input('submit',null,'Agregar +',array('class'=>'btn btn-danger '))}}
{{Form::close()}}
</div>


<hr>
<div>
    @if(isset($datos))
    <div class="text text-info "><span class="glyphicon glyphicon-ok"></span> Se Guardo con exito </div>
    <div class="right">
{{ Form::open(array(
            'action'=>'AtlantidadController@getCreate',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}
            {{Form::input('submit',null,'Agregar +',array('class'=>'btn btn-danger '))}}
{{Form::close()}}
</div>
    @else
        {{ Form::open(array(
                'action'=>'AtlantidadController@postCreate',
                'method'=>'post',
                'role'=>'form',
                'class'=>'add-on'
                ))}}
        <div class="form-group">
            {{Form::label('Fecha Recibido:')}}       
            {{Form::input('text','fecha_recibido','',array('class'=>'','readonly','id'=>'fecha_recibido'))}}   
            {{$errors->first('fecha_recibido')}}
        </div>
        <div class="form-group">
            {{Form::label('Nombre Cliente:')}} 
            {{Form::input('text','nombre','',array('class'=>'input-prepend input-append'))}} 
            {{$errors->first('nombre')}}
        </div>
        <div class="form-group">
            {{Form::label('Tipo de Tarjeta:')}} 
            {{Form::text('tipo_tarjeta','',array('class'=>''))}} 
            {{$errors->first('tipo_tarjeta')}}
        </div>
        <div class="input-prepend">
            {{Form::label('# Tarjeta:')}} 
            {{Form::text('tarjeta','',array('class'=>''))}} 
            {{$errors->first('tarjeta')}}
        </div>
        <div class="form-group">
            {{Form::label('Ciudad:')}} 
            <select name="ciudad">
                <option value="">Elija una Ciudad</option>
                @foreach(Ciudade::all() AS $ciudad) 
                <option value='{{$ciudad->id}}'>{{$ciudad->name}}</option>
                @endforeach
            </select>
            {{$errors->first('ciudad')}}
        </div>
        <div class="input-prepend">
            {{Form::label('Ciudad Foranea:')}} 
            {{Form::text('foranea','',array('class'=>''))}} 
            {{$errors->first('foranea')}}
        </div>
        
        <div>
            {{Form::submit('Guardar',array('class'=>'btn btn-success'))}} 
        </div>
        {{Form::close()}} 
   @endif     
</div>
@stop