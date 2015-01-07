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

		<div CLASS="titulo-bienvenido">Cambio de Devoluci&oacuten Cambio Centro de Trabajo</div>

                <center>{{ Form::open(array(
            'action'=>'ClaroController@postScaneardevolucion',
            'method'=>'POST',
            'files' => true,
            'role'=>'form',
            'class'=>'btn btn-success'
            ))}}
            
            
            {{Form::input('text','id','',array("id"=>"newestado"))}}
            {{Form::input('hidden','observacion','10',array("id"=>"observacion"))}}
            {{Form::input('hidden','ciclo','3',array("id"=>"ciclo"))}}
            {{Form::input('hidden','campo','estado',array("id"=>"campo"))}}
            {{Form::input('submit',null,'Scanear',array('class'=>'btn btn-danger '))}}
{{Form::close()}}</center>
		
</div>
@stop