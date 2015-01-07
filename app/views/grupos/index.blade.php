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
<div style="float: left; padding: 5px;">
{{ Form::open(array(
            'action'=>'GrupoController@getCreate',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}
            {{Form::input('submit',null,'Agregar +',array('class'=>'btn btn-primary '))}}
{{Form::close()}}
</div>
<div style="float: left; padding: 5px;">
{{ Form::open(array(
            'action'=>'GrupoController@getVincular',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}
            {{Form::input('submit',null,'Vincular a Presupuesto +',array('class'=>'btn btn-primary '))}}
{{Form::close()}}  
</div>
<hr>
{{ Form::open(array(
            'action'=>'GrupoController@getIndex',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}

    {{Form::input('text','buscar',Input::old('buscar'),array('class'=>'form-control'))}}
    {{Form::input('submit','Buscar',Input::old('Buscar'),array('class'=>'btn btn-primary'))}}
    <div class="bg-danger" id="_name">{{$errors->first('buscar')}}</div>

{{Form::close()}}          
<center><h1><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Lista Grupos de Cuentas</h1></center>
<label class="label left label-info">Página {{$resultado->getCurrentPage()}} de un total de {{$resultado->getTotal()}} páginas</label>
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th>{{utf8_encode('N�')}}</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Editar</th>
        <tr>      
    <thead>
    <tbody>    
        <!-- inicio mostramos todos los datos de la tabla catalogo -->
        <?php $i=0; ?>
        @foreach($resultado As $datos) <?php $i++; ?>
        <tr>  
            <td>{{$i}}</td>
            <td>{{$datos->codigo}}</td>
            <td>{{($datos->nombre)}}</td>
            <td><a class="btn btn-warning" href="{{URL::action('GrupoController@getEdit',$datos->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
        </tr>
        @endforeach
        <!-- Fin de la tabla catalogo -->
    </tbody>
</table>
    </div>
<div class="container">
    {{$resultado->appends(array("buscar"=>Input::get("buscar")))->links()}}
</div>
@stop
