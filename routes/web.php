<?php

use Illuminate\Support\Facades\Route;

//Definimos los controladores creados
use App\Http\Controllers\ValoresAPagarController;
use App\Http\Controllers\MedidoresController;
use App\Http\Controllers\ConsultaClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Rutas para el usuario
Route::view('/', 'home')->name('home');
Route::view('/login', 'login')->name('login');
Route::view('/consulta_cliente', 'consulta_cliente')->name('consulta_cliente');

//Ruta para proceso de Login
Route::post('/login', [LoginController::class, 'login']);
//Ruta para hacer un logout
Route::post('/salir', [SalirController::class, 'salir'])->name('salir');


//Rutas para personal del municipio
Route::view('/panel', 'panel')->name('panel');
	//Rutas para mostrar (valores a pagar)
		Route::get('/panel', [ValoresAPagarController::class, 'index']);

Route::view('/medidores', 'medidores')->name('medidores');
	//Rutas para mostrar (medidores)
		Route::get('/medidores', [MedidoresController::class, 'index']);

Route::view('/reportes', 'reportes')->name('reportes');
Route::view('/usuarios', 'usuarios')->name('usuarios');

//Controlador para la consulta de valores a pagar por parte del ciudadano
Route::resource('/consulta_cliente', ConsultaClienteController::class);



//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::view('/servicios', 'servicios')->name('servicios');
