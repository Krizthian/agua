<?php

use Illuminate\Support\Facades\Route;

//Definimos los controladores creados
use App\Http\Controllers\ValoresAPagarController; //Controlador de consulta (personal)
use App\Http\Controllers\MedidoresController; //Controlador de Medidores
use App\Http\Controllers\ConsultaClienteController; //Controlador de consulta (ciudadano)
use App\Http\Controllers\LoginController; //Controlador de Login
use App\Http\Controllers\SalirController; //Controlador de Logout
use App\Http\Controllers\UsuariosController; //Controlador de Usuarios

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

Route::view('/usuarios', 'usuarios')->name('usuarios');
	//Rutas para mostrar (usuarios)
		Route::get('/usuarios', [UsuariosController::class, 'index']);

Route::view('/reportes', 'reportes')->name('reportes');

//Controlador para la consulta de valores a pagar por parte del ciudadano
Route::resource('/consulta_cliente', ConsultaClienteController::class);



//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::view('/servicios', 'servicios')->name('servicios');
