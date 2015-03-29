<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Pagina inicio">
        <meta name="author" content="Sistemas Amigables S. de R.L. de C.V.">
        <title>El Corso</title>
        {{ HTML::style('node_modules/bootstrap/dist/css/bootstrap.min.css') }}
        {{ HTML::style('css/main.css') }}
    </head>
    <body style="background: url('img/back.png');">
        <main class="row">
            @yield('content')
        </main>
        @include('template.footer')
        {{ HTML::script('node_modules/datatables/node_modules/jquery/dist/jquery.min.js') }}
        {{ HTML::script('node_modules/bootstrap/dist/js/bootstrap.min.js') }}
        @yield('scripts')
        {{ HTML::script('js/main.js') }}
    </body>
</html>