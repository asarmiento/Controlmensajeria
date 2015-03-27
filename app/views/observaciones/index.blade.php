@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title><?php echo utf8_encode('Observaciones'); ?></title>
@stop
@section('title')
<h1 class="text-lowercase"><?php echo utf8_encode('lista de Observaciones'); ?></h1>
@stop
@section('container')
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Estado</th>
             </tr>
        </thead>
        <tbody>
            @foreach($observaciones AS $datos) 
            <tr>
                <td>{{$datos->id}}</td>
                <td>{{ $datos->name; }}</td>
                <td>{{ $datos->estados->name; }}</td>
               <td><a class="btn btn-warning "><span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">{{ $observaciones->links() }}</div>
@stop