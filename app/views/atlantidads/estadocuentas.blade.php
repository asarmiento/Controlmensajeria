@extends('template.main')
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Sistemas Amigables">
<meta name="keyword" content="palabras, clave">     
<title>Estado Cuenta</title>

@stop

@section('title')
<h1 class="text-lowercase"></h1>
@stop

@section('container') 
     
<center><h2><span class="glyphicon glyphicon-list-alt"><br>Estados de Cuenta "Banco Atlántida"</span></h2></center>

<div style="center">
{{ Form::open(array(
            'action'=>'AtlantidadController@getIndex',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}

    {{Form::input('text','buscar',Input::old('buscar'),array('class'=>'input-xlarge'))}}
    {{Form::input('submit','Buscar',Input::old('Buscar'),array('class'=>'btn'))}}
    <div class="bg-danger" id="_name">{{$errors->first('buscar')}}</div>

{{Form::close()}}  

</div>

<label class="label left label-info">{{$resultado->getTo()}} Filas de un total de {{$resultado->getTotal()}} Filas</label>
<div class="right">
{{ Form::open(array(
            'action'=>'AtlantidadController@getImportarestadoscuenta',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}
            {{Form::input('submit',null,'Importar +',array('class'=>'btn btn-danger '))}}
{{Form::close()}}
</div>
<div class="right">
    <li class="dropdown">                  
        <a href="#" class="btn btn-danger" data-toggle="dropdown">Reportes +<span class="caret"></span></a>  
        <ul class="dropdown-menu" role="menu">                        
            <li><a>{{ HTML::link('/atlantidads/pdf', 'Reporte en PDF',array('target'=>'_black')) }}</a></li>    
            <li><a>{{ HTML::link('/atlantidads/excel', 'Reporte en Excel') }}</a></li>    
        </ul>               
    </li>               
</div>
<hr>
<div class="left">
{{ Form::open(array(
            'action'=>'AtlantidadController@getEstadocuentas',
            'method'=>'GET',
            'role'=>'form',
            'class'=>'form-inline'
            ))}}
            
               {{Form::label('Estado: ')}} 
               {{Form::select('estado',$estado)}} 
              
            {{Form::input('submit',null,'Filtrar',array('class'=>'btn btn-danger '))}}
{{Form::close()}}
</div>
<hr>
<div class="table-responsive"> 
<table class="table table-striped">
    <thead>
        <tr>
            <th width="57">{{utf8_encode('#')}}</th>
            <th width="211">Nº Cliente</th>
            <th width="157">Nombre</th>
            <th width="182">Estado</th>
            <th width="182">Comentario</th>
            <th width="182">Teléfono</th>
            <th width="182">Mensajero</th>
        </tr>      
    </thead>
    <tbody>    
        <!-- inicio mostramos todos los datos de la tabla catalogo -->
        <?php $i=0; ?>
        @foreach($resultado As $datos) <?php $i++; ?>
        <tr>  
            <td>{{$i}}</td>
            <td>{{($datos->codigo)}}</td>
            <td>{{($datos->name_cliente)}}</td>
            <!-- Estado --> 
            {{Form::input('hidden','empresa',$datos->empresas_id,array('id'=>'empresa'))}}
            {{Form::input('hidden','estadoj',$datos->estado_id,array('id'=>'estadoj_'.$datos->id))}}
            <td>
                <div id="estado_{{$datos->id}}" class="estado">
                    <?php if($datos->estado_id ==0): echo 'No tiene Estado';
                    elseif($datos->estado_id ==1): echo 'En Ruta';
                    elseif($datos->estado_id ==2): echo 'Entregado';
                    elseif($datos->estado_id ==3): echo 'Devolucion';
                    elseif($datos->estado_id ==4): echo 'No Entregado';
                    else:
                        echo 'No tiene Estado';
                    endif; ?>
                </div>
                <div id="estadodiv_{{$datos->id}}" class="ocultar estadodiv">
                    <select id="estadoSelect_{{$datos->id}}" class="estadoSelect">
                         @foreach(Estado::all() AS $estado)
                       <option value="{{$estado->id}}">{{$estado->name}}</option>
                       @endforeach
                    </select>
                </div>
            </td>
            
            <!-- Comentario -->
            <td>
                <div id="recibido-{{$datos->id}}" class="recibido">
                    <?php   if($datos->comentario == " " ):  echo "No Tiene";  
                    elseif($datos->comentario==NULL):  echo "No Tiene"; 
                    else:
                        echo $datos->comentario;
                      
                    endif;
                    ?>
</div>
                <div id="recibidodiv_{{$datos->id}}" class="ocultar recibidodiv">{{Form::input('text','recibido','',array('class'=>'recibidop ocultar','id'=>'recibido_'.$datos->id))}}</div>
            </td>
            <!-- Fecha recibido -->
            <td>{{($datos->phone)}}</td>
            
            <!-- Mensajero -->
            <td><div id="mensajero_{{$datos->id}}" class="mensajero">
                    <?php if($datos->mensajero_id >0): ?> 
                   <?php $mensajero =Empleado::find($datos->mensajero_id);  ?>
                     {{$mensajero['fname']}} {{$mensajero['flast']}}
                     <?php   else:
                        echo 'No tiene Mensajero';
                    endif; ?>
                </div>
                <div>
                    <select id="empleadoSelect_{{$datos->id}}" class="ocultar empleadoSelect" >
                       @foreach(Empleado::all() AS $data)
                       <option value="{{$data->id}}">{{$data->fname}} {{$data->flast}}</option>
                       @endforeach
                        </select>
                </div></td>
        </tr>
        @endforeach
        <!-- Fin de la tabla catalogo -->
    </tbody>
</table>
    </div>
<div class="pagination">
    {{$resultado->appends(array("buscar"=>Input::get("buscar")))->links()}}
</div>
@stop
