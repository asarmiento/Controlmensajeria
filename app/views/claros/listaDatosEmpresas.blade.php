@extends('template.main')

@section('head')
    <meta name="description" content="Pagina inicio">
    <meta name="author" content="Sistemas Amigables">
    <meta name="keyword" content="palabras, clave">     
    <title>Estado Cuenta</title>
@stop

@section('styles')
    {{ HTML::style('css/DT_bootstrap.css') }}
@stop

@section('scripts')
    {{ HTML::script('js/DT_bootstrap.js') }}
@stop

@section('container') 
    <center>
        <h2>
            <span class="icon-list-alt"></span>
            <span>Ciclo C-48</span>
            <img src="{{asset('img/logo-claro.png')}}">
        </h2>
    </center>
    <div class="span6">
        <li class="dropdown" style="list-style:none;">                  
            <a href="#" class="btn btn-danger" data-toggle="dropdown">Reportes +<span class="caret"></span></a>  
            <ul class="dropdown-menu" role="menu">                        
                <li><a>{{ HTML::link('/claros/pdfc48', 'Reporte en PDF',array('target'=>'_black')) }}</a></li>    
                <li><a>{{ HTML::link('/claros/excelc48', 'Reporte en Excel') }}</a></li>    
            </ul>               
        </li>    
    </div>
        <!-- <div class="span6">
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Buscar</button>
            </form>        
        </div> -->
    <hr>
    <div class="table-responsive"> 
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="57">{{('#')}}</th>
                <th width="211">Código</th>
                <th width="157">Nombre</th>
                <th width="157">Tipo Cliente</th>
                <th width="182">Estado</th>
                <th width="182">Observación</th>
                <th width="182">Comentario</th>
                <th width="182">Mensajero</th>
                <th width="182">Ciudad</th>
            </tr>      
        </thead>
       <tbody>    
            <!-- inicio mostramos todos los datos de la tabla catalogo -->
            <?php $i=0; ?>
            @foreach($datosEmpresas As $datos) <?php $i++;   ?>
            <tr>  
                <td>{{$i}}</td>
                <td>{{($datos->codigo)}}</td>
                <td>{{($datos->name_cliente)}}</td>
                <td>{{($datos->tipo_cliente)}}</td>
               
                <td>
                    <div id="" class="">{{($datos->observaciones->estados->name)}}</div>
                    
                </td>
                <!-- Observación -->
                <td><div id="ClaroObservacion_{{$datos->id}}" class="ClaroObservacion">{{($datos->observaciones->name)}}</div>
                    
                </td>
                <!-- Comentario -->
                <td>
                    <div id="recibido-{{$datos->id}}" class="recibido"></div>
                </td>

                <!-- Empleados -->
                <td><div id="mensajero_{{$datos->id}}" class="mensajero">@if(($datos->empleados_id==null))  @else {{$datos->empleados->nameCompleto()}} @endif </div>
                    </td>
                    <td>
                       <div >{{($datos->ciudades->name)}}</div>
                    </td>
            </tr>
            @endforeach
            <!-- Fin de la tabla catalogo -->
        </tbody>
    </table>
        </div>
    <div class="pagination">
        {{$datosEmpresas->appends(array("buscar"=>Input::get("buscar")))->links()}}
    </div>
@stop

