@extends('template.base')
   
@section('styles')
        @parent
        {{ HTML::style('css/styles.css'); }}
    @stop
@section('head')
<meta name="description" content="Pagina inicio">
<meta name="author" content="Sistemas Amigables S. de R.L. de C.V.">
<meta name="keyword" content="palabras, clave">     
<title>El Corso</title>

@stop
@section('content')


<div class="box-colums">

<div class="titulo-bienvenido">Bienvenid@</div>
<div class="texto-inicio-sesion">Puedes iniciar sesión de una manera sencilla. <br>Llena los espacios en blanco para poder ingresar al Sistema.</div>

<div class="candado "></div>
<div class="box-login"><br>

            {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}

            @if(Session::has('mensaje_error'))
                {{ Session::get('mensaje_error') }}
            @endif

           {{ Form::open(array('url' => '/login', 'action'=>'URL::action("AuthController@postLogin")', 'method'=>'post')) }}
            <div class="">
                <label for="username">{{ Form::label('usuario', 'Usuario:') }} </label></div>
                {{ Form::text('username', Input::old('username'), array('class'=>'form-control')); }} <br><br>
            
            <div class="">
                <label for="password">{{ Form::label('contraseña', 'Contraseña:') }} </label>
                {{ Form::password('password', array('class'=>'form-control')); }}
            </div>
            <div class="">
                {{ Form::label('lblRememberme', 'Recordar contraseña') }}
                {{ Form::checkbox('rememberme', true) }} <br><br>
                <center>{{ Form::submit('    Entrar    ', array('class'=>'btn btn-primary')) }}</center>
            </div>
            {{ Form::close() }}
            </div></div>
      <div style="">
              

        <footer class="footer">
            <div id="footer" class="text-center footer">
                <div class="">
                    <p>Desarrollado por <a href="http://sistemasamigables.com">© 2014 Sistemas Amigables.</a>  All rights reserved.</p>
                    <p class=""><a href="http://elcorso.hn/">Regresar al Sitio</a> | <a href="http://elcorso.hn/?q=node/9">Sobre Corporación El Corso</a> | <a href="http://elcorso.hn/pdf/Manual-de-usuario-El-Corso.pdf">Ayuda </a></p>
              </div>
            </div>	
        </footer>	
            </div>
@stop











