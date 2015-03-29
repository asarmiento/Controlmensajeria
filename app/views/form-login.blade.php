@extends('template.login')
@section('content')
    <div class="login">
        <div class="container">
            <div class="text-center">
                <h1 class="msg-home">Bienvenid@</h1>
                <p class="msg-login">
                    <span>Puedes iniciar sesión de una manera sencilla.</span>
                    <br>
                    <span>Llena los espacios en blanco para poder ingresar al Sistema.</span>
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registrarse</h3>
                        </div>
                        <div class="panel-body">
                            {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}
                            @if(Session::has('mensaje_error'))
                                <div class="form-group has-error">
                                    <label class="control-label">{{ Session::get('mensaje_error') }}</label>
                                </div>
                            @endif
                            @if(Session::has('mensaje_logout'))
                                <div class="form-group has-success">
                                    <label class="control-label">{{ Session::get('mensaje_logout') }}</label>
                                </div>
                            @endif
                            {{ Form::open(array('url' => '/login', 'action'=>'URL::action("AuthController@postLogin")', 'method'=>'post')) }}
                                <fieldset>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control" name="email" type="text" title="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contraseña">Contraseña</label>
                                        <input id="contraseña" class="form-control" name="password" title="password" type="password" required>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="rememberme" type="checkbox" value="1"> Recordar Contraseña
                                        </label>
                                    </div>
                                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Ingresar">
                                </fieldset>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop