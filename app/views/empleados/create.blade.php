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
@section('content') 
<div>
    @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
   
        {{ Form::open(array(
                'action'=>'guardar-empleados',
                'method'=>'post',
                'role'=>'form',
                'class'=>'add-on'
                ))}}
        <div class="form-group">
            {{Form::label('Primer Nombre:')}}       
            {{Form::input('text','fname','',array('class'=>'','id'=>''))}}   
         
        </div>
        <div class="form-group">
            {{Form::label('Segundo Nombre:')}} 
            {{Form::input('text','sname','',array('class'=>'input-prepend input-append'))}} 
         
        </div>
        <div class="form-group">
            {{Form::label('Primer Apellido:')}} 
            {{Form::input('text','flast','',array('class'=>''))}} 
          
        </div>
        <div class="input-group">
            {{Form::label('Segundo Apellido:')}} 
            {{Form::input('text','slast','',array('class'=>''))}} 
      
        </div>
        <div class="input-group">
            {{Form::label('Cedula:')}} 
            {{Form::input('text','cedula','',array('class'=>''))}} 
 
        </div>
        <div class="input-group">
            {{Form::label('Celular:')}} 
            {{Form::input('text','celular','',array('class'=>''))}} 
    
        </div>
        <div class="form-group">
            {{Form::label('Ciudad:')}} 
            {{Form::select('ciudades_id',$ciudades)}} 
           
           
        </div>
 
        <div>
            {{Form::submit('Guardar',array('class'=>'btn btn-success'))}} 
        </div>
        {{Form::close()}} 
    
</div>
@stop