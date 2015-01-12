@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Sistemas Amigables">
<meta name="keyword" content="palabras, clave">     
<title>Importar</title>
@stop
<?php
$mes = array(
    '0' => 'All',
    '9' => 'Septiembre-2014',
    '10' => 'Octubre-2014',
    '11' => 'Noviembre-2014',
    '12' => 'Diciembre-2014',
    '1' => 'Enero-2015',
    '2' => 'Febrero-2015',
    '3' => 'Marzo-2015',
    '4' => 'Abril-2015',
    '5' => 'Mayo-2015',
    '6' => 'Junio-2015',
);
?>
@section('title')
<h1 class="text-lowercase"></h1>
@stop

@section('container') 

<center><h2><span class="glyphicon glyphicon-list-alt"><br>Importar Ciclos <img src="http://sistema.elcorso.hn/asset/img/logosclientes/logo-claro.png"></span></h2></center>
<hr>

<center>{{ Form::open(array(
            'action'=>'ClaroController@postImportar',
            'method'=>'POST',
            'files' => true,
            'role'=>'form',
            'class'=>'btn btn-success'
            ))}}
            
            
            {{Form::file('importar')}}
             {{Form::select('ciclo',$drop)}}
            {{Form::select('mes',$mes)}}
            
            {{Form::input('submit',null,'importar',array('class'=>'btn btn-danger '))}}
{{Form::close()}}</center>
@stop