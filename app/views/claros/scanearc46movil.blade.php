@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title>Escanear</title>
<script type="text/javascript">
    $(document).ready(function(){ $('#newestado').focus();});
</script>
@stop
@section('container') 
<div class="menu-inicio">

		<div CLASS="titulo-bienvenido">Cambio de Estado Ciclo 46 Movil</div>

                <center>{{ Form::open(array(
            'action'=>'ClaroController@postScanearciclo',
            'method'=>'POST',
            'files' => true,
            'role'=>'form',
            'class'=>'btn btn-success'
            ))}}
            
            
            {{Form::input('text','id','',array("id"=>"newestado"))}}
            {{Form::input('hidden','ciclo','6',array("id"=>"campo"))}}
            {{Form::input('submit',null,'Scanear',array('class'=>'btn btn-danger '))}}
{{Form::close()}}</center>
		
</div>
@stop