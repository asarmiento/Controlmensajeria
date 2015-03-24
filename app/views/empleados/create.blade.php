@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title></title>
@stop
@section('title')
<h1 class="text-lowercase">Mensajeros</h1>
@stop
@section('container') 
<div>
    @if(isset($datos))
    <div class="text text-info "><span class="glyphicon glyphicon-ok"></span> Se Guardo con exito </div>
 
    @else
        {{ Form::open(array(
                'action'=>'guardar-empleados',
                'method'=>'post',
                'role'=>'form',
                'class'=>'add-on'
                ))}}
        <div class="form-group">
            {{Form::label('Primer Nombre:')}}       
            {{Form::input('text','fname','',array('class'=>'','id'=>''))}}   
            {{$errors->first('fname')}}
        </div>
        <div class="form-group">
            {{Form::label('Segundo Nombre:')}} 
            {{Form::input('text','sname','',array('class'=>'input-prepend input-append'))}} 
            {{$errors->first('sname')}}
        </div>
        <div class="form-group">
            {{Form::label('Primer Apellido:')}} 
            {{Form::input('text','flast','',array('class'=>''))}} 
            {{$errors->first('flast')}}
        </div>
        <div class="input-group">
            {{Form::label('Segundo Apellido:')}} 
            {{Form::input('text','slast','',array('class'=>''))}} 
            {{$errors->first('slast')}}
        </div>
        <div class="input-group">
            {{Form::label('Cedula:')}} 
            {{Form::input('text','cedula','',array('class'=>''))}} 
            {{$errors->first('cedula')}}
        </div>
        <div class="input-group">
            {{Form::label('Celular:')}} 
            {{Form::input('text','celular','',array('class'=>''))}} 
            {{$errors->first('celular')}}
        </div>
        <div class="form-group">
            {{Form::label('Ciudad:')}} 
            {{Form::select('ciudades_id',$ciudades)}} 
           
            {{$errors->first('ciudades_id')}}
        </div>
 
        <div>
            {{Form::submit('Guardar',array('class'=>'btn btn-success'))}} 
        </div>
        {{Form::close()}} 
   @endif     
</div>
@stop