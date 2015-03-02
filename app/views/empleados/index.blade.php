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

<center><h2><span class="glyphicon glyphicon-list-alt"><br>Agregar Mensajeros</span></h2></center>
<hr>
<div class="right">
{{ Form::open(array(
            'action'=>'MensajeroController@getIndex',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}
            {{Form::input('submit',null,'Agregar +',array('class'=>'btn btn-danger '))}}
{{Form::close()}}
</div>


<hr>

<div >
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Cedula</th>
                <th>Celular</th>
                <th>Estado</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody><?php $i=0; ?>
            @foreach($empleados AS $datos) <?php $i++; ?>
            <tr>
                <td>{{$i}}</td>
                <td>{{ $datos->fname; }} {{ $datos->sname; }} {{ $datos->flast; }} {{ $datos->slast; }}</td>
                <td>{{ $datos->ciudad; }}</td>
                <td>{{ $datos->cedula; }}</td>
                <td>{{ $datos->celular; }}</td>
                @if($datos->estado==0)
                <td>Activo</td>
                @elseif($datos->esatdo==1)
                <td>Desactivo</td>
                @endif
                <td><a class="btn btn-warning "><span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination"><li>{{ $resultado->links() }}<li></div>
</div>
@stop