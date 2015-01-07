@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Anwar Sarmiento">
<meta name="keyword" content="palabras, clave">     
<title>Escanear</title>

@stop
@section('container') 
<div class="menu-inicio">

		<div CLASS="titulo-bienvenido">Cambio de Estado <img src="http://sistema.elcorso.hn/asset/img/logosclientes/logo-claro.png"></div>

                <center>{{ Form::open(array(
            'action'=>'ClaroController@postBarrido',
            'method'=>'POST',
            'files' => true,
            'role'=>'form',
            'class'=>'btn btn-success'
            ))}}
            
            
            {{Form::select('estadoantes',$drop)}}
            {{Form::select('ciclo',$ciclo)}}
            {{Form::select('mes',array('1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'))}}
            {{Form::select('year',array('2014'=>'2014','2015'=>'2015','2016'=>'2016'))}}
            {{Form::select('ciudad',$ciudad)}}
            {{Form::select('estadodespues',$drop,null,array('id'=>'barrido'))}}
            <div id="observEnt" class="buscar-ciclo ocultar">
<label>Observación: </label>    <select name="observEnt"  class="buscar-estado-lista ">
        <option value="">All</option>
            <option value="1">Bajo puerta</option>
                    <option value="2">Porch</option>
                    <option value="3">Buzón</option>
                    <option value="4">Recibido por el titular</option>
                    <option value="5">Recibido por familiar</option>
                    <option value="6">Recibido por comprañero de  trabajo</option>
            </select>
</div>
<div id="observDev" class="buscar-ciclo ocultar">
 <label>Observación: </label>   
    <select  name="observDev"  class="buscar-estado-lista ">
        <option value="">All</option>
            <option value="7">Mala Dirección</option>
                    <option value="8">Dirección incompleta</option>
                    <option value="9">Cambio de dirección</option>
                    <option value="10">Cambio de centro de trabajo</option>
                    <option value="11">Desconocido en dirección</option>
                    <option value="12">Está de vacaciones</option>
                    <option value="13">Dirección en zona de alto riesgo</option>
                    <option value="14">Dirección en blanco</option>
                    <option value="15">Rechazada por el cliente</option>
            </select>

</div>
            {{Form::input('submit',null,'Barrido Ciudad',array('class'=>'btn btn-danger '))}}
{{Form::close()}}</center>
                <hr>
                   <center>{{ Form::open(array(
            'action'=>'ClaroController@postBarridoall',
            'method'=>'POST',
            'files' => true,
            'role'=>'form',
            'class'=>'btn btn-success'
            ))}}
            
            
            {{Form::select('estadoantes',$drop)}}
            {{Form::select('ciclo',$ciclo)}}
            {{Form::select('mes',array('1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre'))}}
            {{Form::select('year',array('2014'=>'2014','2015'=>'2015','2016'=>'2016'))}}
            {{Form::select('estadodespues',$drop)}}
            {{Form::input('submit',null,'Barrido All',array('class'=>'btn btn-danger '))}}
{{Form::close()}}</center>
</div>
@stop