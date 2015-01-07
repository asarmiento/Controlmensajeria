@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title></title>
@stop
<?php
$mes = array(
    '0' => 'All',
    '9' => 'Septiembre-2014',
    '10' => 'Octubre-2014',
    '11' => 'Noviembre-2014',
    '12' => 'Diciembre-2014',
);
?>
@section('title')
<h1 class="text-lowercase"></h1>
@stop

@section('container') 

<center><h2><span class="glyphicon glyphicon-list-alt"><br>Importar Estados de Cuenta Lps. "Ficohsa"</span></h2></center>
<hr>

<center>{{ Form::open(array(
            'action'=>'FicohsaController@postImportarlempiras',
            'method'=>'POST',
            'files' => true,
            'role'=>'form',
            'class'=>'btn btn-success'
            ))}}
            
            
            {{Form::file('importar')}}
            {{Form::select('mes',$mes)}}
            
            {{Form::input('submit',null,'importar',array('class'=>'btn btn-danger '))}}
{{Form::close()}}</center>
@stop