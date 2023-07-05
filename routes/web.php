<?php

use Illuminate\Support\Facades\Route;

//Definimos los controladores creados
use App\Http\Controllers\ValoresAPagarController;
use App\Http\Controllers\MedidoresController;
use App\Http\Controllers\ConsultaClienteController;

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

//Rutas para personal del municipio
Route::view('/panel', 'panel')->name('panel');
	//Rutas para mostrar (valores a pagar)
		Route::get('/panel', [ValoresAPagarController::class, 'index']);

Route::view('/medidores', 'medidores')->name('medidores');
	//Rutas para mostrar (medidores)
		Route::get('/medidores', [MedidoresController::class, 'index']);

Route::view('/reportes', 'reportes')->name('reportes');
Route::view('/usuarios', 'usuarios')->name('usuarios');
Route::resource('/consulta_cliente', ConsultaClienteController::class);



//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::view('/servicios', 'servicios')->name('servicios');
