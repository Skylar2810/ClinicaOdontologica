<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('pacientes', App\Http\Controllers\PacienteController::class);
Route::resource('estados',  App\Http\Controllers\EstadoController::class);
Route::resource('sexos', App\Http\Controllers\SexoController::class);
Route::resource('tratamientos', App\Http\Controllers\TratamientoController::class);
Route::resource('especialidades', App\Http\Controllers\EspecialidadeController::class);



Route::resource('eventos', App\Http\Controllers\EventoController::class);
Route::post('/eventos/agregar', [App\Http\Controllers\EventoController::class, 'store'])->name('eventos.store');
Route::delete('/eventos/eliminar/{eventoId}', [App\Http\Controllers\EventoController::class, 'eliminar']);
Route::patch('/eventos/posponer/{id}', [App\Http\Controllers\EventoController::class, 'posponer']);
Route::get('/mis-citas', [App\Http\Controllers\EventoController::class, 'mostrarCitas'])->name('eventos.citas');





Route::resource('pagos', App\Http\Controllers\PagoController::class);
Route::get('/pagos/pdf/{id}', [App\Http\Controllers\PagoController::class, 'generarPDF'])->name('pagos.pdf');

Route::resource('usuarios', App\Http\Controllers\UserController::class);

Route::get('/seguimientos/{tratamiento_id}', [ App\Http\Controllers\SeguimientoController::class, 'show'])->name('seguimientos.show');
Route::post('/seguimientos', [ App\Http\Controllers\SeguimientoController::class, 'store'])->name('seguimientos.store');
Route::put('/seguimientos/{id}', [ App\Http\Controllers\SeguimientoController::class, 'update'])->name('seguimientos.update');
Route::get('/reporte-seguimientos/{paciente_id}', [App\Http\Controllers\SeguimientoController::class, 'generarReporte'])->name('reporte.seguimientos');

Route::get('radiografias/{paciente_id}', [App\Http\Controllers\RadiografiaController::class, 'index'])->name('radiografias.index');
Route::post('radiografias', [App\Http\Controllers\RadiografiaController::class, 'store'])->name('radiografias.store');
Route::delete('radiografias/{radiografia}', [App\Http\Controllers\RadiografiaController::class, 'destroy'])->name('radiografias.destroy');
Route::get('radiografias/pdf/{paciente_id}', [App\Http\Controllers\RadiografiaController::class, 'generarPDF'])->name('radiografias.pdf');


Route::get('/mostrar-radiografia/{filename}', function ($filename) {
    $path = 'C:/Users/CIELO/Pictures/radiografias/' . $filename;

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return response($file, 200)->header("Content-Type", $type);
});
