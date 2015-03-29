@extends('template.base')
@section('content')
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2">
            <br>
            <ul class="">  
                <img src="{{asset('img/logo-corso.png')}}" class="img-responsive">
            </ul>
            <div class="menu-cliente" id=""> 
                <div class="menu-tittle">| Clientes -</div>   
                    <ul class="nav">
                        <li class="dropdown">                  
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Banco Occidente<span class="caret"></span></a>  
                            <ul class="dropdown-menu" role="menu">                        
                                <li><a>{{ HTML::link('/occidentes/estadocuenta', 'Estado Cuenta') }}</a></li>    
                                <li><a>{{ HTML::link('/occidentes/', 'Cheques Devueltos') }}</a></li>    
                            </ul>               
                        </li>               
                        <li class="dropdown">   
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Banco Continental<span class="caret"></span></a>  
                            <ul class="dropdown-menu" role="menu">                   
                                <li><a>{{  HTML::link('/continentals/estadocuenta', 'Estado Cuenta de Cheques') }}</a></li>    
                                <li><a>{{ HTML::link('/continentals/estadocuentatarjetas', 'Estados de Cuenta Tarjetas') }}</a></li> 
                                <li><a>{{ HTML::link('/continentals/notasdebito', 'Notas de debito') }}</a></li>     
                            </ul>                
                        </li> 
                        <li class="dropdown">  
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Banco Atlantidad<span class="caret"></span></a>   
                            <ul class="dropdown-menu" role="menu">              
                                <li><a>{{ HTML::link('/atlantidads/estadocuentas', 'Estados de Cuenta') }}</a></li> 
                                <li><a>{{ HTML::link('/atlantidads/', 'Tarjetas de Credito') }}</a></li>        
                            </ul>               
                        </li>              
                        <li class="dropdown">  
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Editorial Hablemos Claro<span class="caret"></span></a>   
                            <ul class="dropdown-menu" role="menu">              
                                <li><a>{{ HTML::link('/hablemosclaros/hablemosclaro', 'Revista Hablemos Claro') }}</a></li> 
                                <li><a>{{ HTML::link('/hablemosclaros/asdeportiva', 'Revista AS Deportiva') }}</a></li>
                                <li><a>{{ HTML::link('/hablemosclaros/cromos', 'Revista Cromos') }}</a></li>
                                <li><a>{{ HTML::link('/hablemosclaros/hablemosclarofinanciera', 'Revista Hablemos Claro Financiera') }}</a></li>
                                <li><a>{{ HTML::link('/hablemosclaros/cometo', 'Revista  Come To Honduras') }}</a></li>
                            </ul>               
                        </li>              
                        <li class="dropdown">   
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Banco Ficohsa<span class="caret"></span></a>   
                            <ul class="dropdown-menu" role="menu">                       
                                <li><a>{{ HTML::link('/ficohsas/estadocuentalps', 'Estados de Cuenta en Lempiras') }}</a></li>  
                                <li><a>{{ HTML::link('/ficohsas/estadocuentadolar', 'Estados de Cuenta en Dolares') }}</a></li>  
                            </ul>               
                        </li>
                        <li class="dropdown">   
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Alcance<span class="caret"></span></a>   
                            <ul class="dropdown-menu" role="menu">                       
                                <li><a>{{ HTML::link('/users/add', 'Agregar Usuario') }}</a></li>  
                                <li><a>{{ HTML::link('/users', 'Ver Usuarios') }}</a></li>  
                            </ul>               
                        </li> 
                        <li class="dropdown">   
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Columbus<span class="caret"></span></a>   
                            <ul class="dropdown-menu" role="menu">                       
                                <li><a>{{ HTML::link('/columbus/', 'Estados de Cuenta') }}</a></li>   
                            </ul>               
                        </li>    
                        <li class="dropdown">   
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Claro<span class="caret"></span></a>   
                            <ul class="dropdown-menu" role="menu">
                                <li><a>{{ HTML::link('/claros/', 'Administración') }}</a></li>
                                <li><a>{{ HTML::link('/claro/ciclo', 'Ciclo C-48') }}</a></li>
                                <li><a>{{ HTML::link('/claro/ciclo', 'Ciclo C-46 TV') }}</a></li>
                                <li><a>{{ HTML::link('/claro/ciclo', 'Ciclo C-46 Movil') }}</a></li>   
                            </ul>               
                        </li>    
                        <li class="dropdown">   
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Usuarios<span class="caret"></span></a>                    
                            <ul class="dropdown-menu" role="menu">                        
                                <li><a>{{ HTML::link('/users/add', 'Agregar Usuario') }}</a></li> 
                                <li><a>{{ HTML::link('/users', 'Ver Usuarios') }}</a></li>        
                            </ul>                </li>               
                        <li class="dropdown">                   
                            <a href="#" class="boton-cliente" data-toggle="dropdown">Opciones&nbsp;<span class=" glyphicon glyphicon-cog"></span></a>   
                            <ul class="dropdown-menu" role="menu">    
                                <li>{{ HTML::link('/empleados/', 'Empleados') }}</li>  
                                <li><a href='{{ Route('lista-observacion') }}'>Observaciones </a></li>  
                                <li>{{ HTML::link('/logout', 'Cerrar sesión') }}</li>       
                            </ul>              
                        </li>
                    </ul>     
            </div><!-- /.navbar-collapse -->   
        </div>
        <div class="span10">
            <br>
             @yield('container')
        </div>
    </div>
</div>
@stop