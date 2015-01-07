@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title></title>
@stop
@section('title')
<h1 class="text-lowercase"></h1>
@stop
@section('container') 

<center><h2><span class="glyphicon glyphicon-list-alt"><br>Agregar cheque devuelto "Banco de Occidente"</span></h2></center>
<hr>


<div class="right">
<button onclick="location = 'index'"  class="btn btn-primary" type="button">
    Ver Lista Completa <span class="badge"></span>
</button>
</div>

<div>
    @if(isset($datos))
    <div class="text text-info "><span class="glyphicon glyphicon-ok"></span> Se Guardo con exito el Codigo</div>
    @else
        {{ Form::open(array(
                'action'=>'OccidenteController@postCreate',
                'method'=>'post',
                'role'=>'form',
                'class'=>'add-on'
                ))}}
        
        <div class="form-group">
            {{Form::label('Fecha Cheque:')}}       
            {{Form::input('text','fechacheque','',array('class'=>'','id'=>'fechacheque','readonly'))}}   
            {{$errors->first('fechacheque')}}
        </div>
        <div class="form-group">
            {{Form::label('Nombre:')}} 
            {{Form::text('nombre')}} 
            {{$errors->first('nombre')}}
        </div>
        <div class="form-group">
            {{Form::label('Valor:')}} 
                    <div class="input-prepend">
			<span class="add-on">Lps.</span>
		</div>{{Form::text('valor','',array('class'=>'input-medium'))}} 
            {{$errors->first('valor')}}
        </div>
        



        <div class="form-group">
            {{Form::submit('Guardar',array('class'=>'btn btn-primary'))}} 
        </div>
        {{Form::close()}} 
   @endif     
</div>
@stop