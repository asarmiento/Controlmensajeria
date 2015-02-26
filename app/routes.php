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
    
    Route::controller('users', 'UserController');
    Route::controller('generales', 'GeneralController');
    Route::controller('columbus', 'ColumbusController');
    Route::controller('occidentes', 'OccidenteController');
    Route::controller('atlantidads', 'AtlantidadController');
    Route::controller('ficohsas', 'FicohsaController');
    Route::controller('continentals', 'ContinentalController');
    Route::controller('hablemosclaros', 'HablemosclaroController');
    Route::controller('claros','ClaroController');
    Route::controller('mensajeros','MensajeroController');
    Route::controller('setup','SetupController');
    // Esta ruta nos servirÃ¡ para cerrar sesiÃ³n.
    Route::get('logout', 'AuthController@logOut');
});

Route::get('configuracion/crear-estado', 'EstadoController@create');


use Anouar\Fpdf\Fpdf as baseFpdf;
class PDF extends baseFpdf
{
// Page header
function Header()
{
    // Logo
     $this->Image('http://system.elcorso.hn/public/img/logo-corso_pdf.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
   // Title
    $this->Cell(0,10,'Reporte de Entrega',0,0,'C');
    // Line break
    $this->Ln(15);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

