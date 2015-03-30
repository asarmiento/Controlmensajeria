<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */


// Nos mostrarÃ¡ el formulario de login.
Route::get('login', 'AuthController@showLogin');

// Validamos los datos de inicio de sesiÃ³n.
Route::post('login', 'AuthController@postLogin');
Route::get('empleados','EmpleadoController@index');

// Nos indica que las rutas que estÃ¡n dentro de Ã©l sÃ³lo serÃ¡n mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function() {
    // Esta serÃ¡ nuestra ruta de bienvenida.
    Route::get('/', function() {
        return View::make('hello');
    });


    /**
     * Routes Claro
     */
    
    /*Route::get('claro', function(){
        echo "OK";
    });*/
    Route::get('claro', ['as' => 'claro', 'uses' => 'ClaroController@index']);
    Route::get('claro/{name}', ['as'=> 'producto_claro', 'uses'=>'ClaroController@dataProduct']);
    Route::get('claro/importar-ciclo/{id}',['as'=>'importar-ciclo','uses'=>'ClaroController@importarClaro']);
    Route::post('claro/importar-ciclo',['as'=>'save-ciclo','uses'=>'ClaroController@importarExcelClaro']);
    
    /* Routes Empresas-CLARO */
    Route::post('claro/scanear-ciclo',['as'=>'scanear-ciclo','uses'=>'EmpresasController@scanearCiclo']);
    Route::get('claro/ciclo','EmpresasController@ListaDatosEmpresas');
    /**
     *  Routes Historial
     */
    Route::get('historial-productos/{id}',['as'=>'historial-productos','uses'=>'HistorialsController@index']);
    Route::put('historial-delete/{id}',['as'=>'historial-delete','uses'=>'HistorialsController@destroy']);
    Route::get('descarga-productos/{id}',['as'=>'descarga-productos','uses'=>'HistorialsController@descargasProducto']);
    /**
     *  Routes Empleados
     */
    Route::get('empleados/registrar-empleados',['as'=>'registrar-empleados','uses'=>'EmpleadoController@create']);
    Route::get('empleados',['as'=>'ver-empleados','uses'=>'EmpleadoController@index']);
    Route::post('empleados/guardar-empleados',['as'=>'guardar-empleados','uses'=>'EmpleadoController@store']);
    Route::get('empleados/editar-empleados/{id}',['as'=>'editar-empleados','uses'=>'EmpleadoController@edit']);
    Route::post('empleados/update-empleados/{id}',['as'=>'update-empleados','uses'=>'EmpleadoController@update']);
    /**
     * Routes Obsevaciones
     */
    Route::get('observaciones/lista-observacion',['as'=>'lista-observacion','uses'=>'ObservacionController@index']);
    
    
    /**
     * Test
     */
    Route::get('test', 'TestController@index');
 
    Route::controller('setup','SetupController');
    // Esta ruta nos servirÃ¡ para cerrar sesiÃ³n.
    Route::get('logout', 'AuthController@logOut');
});