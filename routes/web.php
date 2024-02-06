<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\FormacionPIUController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\ReconocimientoController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * LOGIN
 */
Route::get('/', [LoginController::class, 'getLogin'])->name('null');
Route::get('login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
/**
 * HOME
 */
Route::get('/home', [HomeController::class, 'index'])->name('home');
/**
 * GESTION
 */
Route::get('FormacionPIU/', [FormacionPIUController::class, 'Index'])->name('FormacionPIUIndex');
Route::get('FormacionPIU/{idRegistro}', [FormacionPIUController::class, 'Tabs'])->name('FormacionPIUTabs');
/**
 * REGISTRO
 */
Route::get('Registro/index/{idRegistro}', [RegistroController::class, 'index'])->name('RegistroIndex');
Route::post('Registro/create', [RegistroController::class, 'Create'])->name('RegistroCreate');
Route::post('Registro/update/{idRegistro}', [RegistroController::class, 'Update'])->name('RegistroUpdate');
Route::post('Registro/delete/{idRegistro}', [RegistroController::class, 'Delete'])->name('RegistroDelete');
/**
 * RECONOCIMIENTO
 */
Route::get('Reconocimiento/index/', [ReconocimientoController::class, 'Index'])->name('ReconocimientoPIUIndex');
/**
 * INFORMACION
 */
Route::get('Informacion/index/{idRegistro}', [InformacionController::class, 'Index'])->name('InformacionPIUIndex');
Route::post('Informacion/create', [InformacionController::class, 'Create'])->name('InformacionPIUCreate');
Route::post('Informacion/update/{idInformacion}', [InformacionController::class, 'Update'])
    ->name('InformacionPIUUpdate');
/**
 * RESULTADOS
 */
Route::get('Resultado/index/{idRegistro}', [ResultadoController::class, 'index'])->name('ResultadosIndex');
Route::post('Resultado/create', [ResultadoController::class, 'Create'])->name('ResultadosCreate');
Route::post('Resultado/update/{idInformacion}', [ResultadoController::class, 'Update'])
    ->name('ResultadosUpdate');
/**
 * REPORTES
 */
Route::get('Reporte/{idRegistro}', [ReporteController::class, 'index'])->name('ReporteIndex');

/**
 * USUARIOS
 */
Route::get('getUsuarios', [UserController::class, 'getUsuarios'])->name('getUsuarios');
Route::post('registrarUsuario', [UserController::class, 'registrarUsuario'])->name('registrarUsuario');
Route::post('actualizarUsuario', [UserController::class, 'actualizarUsuario'])->name('actualizarUsuario');
Route::post('eliminarUsuario', [UserController::class, 'eliminarUsuario'])->name('eliminarUsuario');
Route::post('actualizarPassword', [ResetPasswordController::class, 'actualizarPassword'])->name('actualizarPassword');
