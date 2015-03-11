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
<div>
    @if(isset($datos))
    <div class="text text-info "><span class="glyphicon glyphicon-ok"></span> Se Guardo con exito </div>
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
    @else
        {{ Form::open(array(
                'action'=>'MensajeroController@postCreate',
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
            <select name="ciudad">
                <option value="">Elija una Ciudad</option>
                @foreach(Ciudade::all() AS $ciudad) 
                <option value='{{$ciudad->id}}'>{{$ciudad->name}}</option>
                @endforeach
            </select>
            {{$errors->first('ciudad')}}
        </div>
        <div class="input-prepend">
            {{Form::label('Estado:')}} 
             <select name="estado">
                <option value="1">Activo</option>
                <option value="0">Desactivar</option>
            </select>
            {{$errors->first('foranea')}}
        </div>
        
        <div>
            {{Form::submit('Guardar',array('class'=>'btn btn-success'))}} 
        </div>
        {{Form::close()}} 
   @endif     
</div>
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
        <tbody><?php $i=0; //dd($resultado); ?>
            @foreach($resultado AS $datos) <?php $i++; ?>
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