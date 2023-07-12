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

/*Rutas para el usuario*/

//Inicio
	Route::view('/', 'home')->name('home');
		Route::get('/consulta', [ConsultaClienteController::class, 'index'])->name('consulta.index');

//Login
	Route::view('/login', 'login')->name('login');
		//Ruta para proceso de Login
		Route::post('/login', [LoginController::class, 'login']);
		//Ruta para hacer un logout
		Route::post('/salir', [SalirController::class, 'salir'])->name('salir');

/*Rutas para el personal del Municipio*/

Route::view('/panel', 'panel')->name('panel');
	//Rutas para mostrar (valores a pagar)
		Route::get('/panel', [ValoresAPagarController::class, 'index']);
		Route::get('/panel/busqueda', [ValoresAPagarController::class, 'busqueda'])->name('panel.busqueda');

Route::view('/medidores', 'medidores')->name('medidores');
	//Rutas para mostrar (medidores)
		Route::get('/medidores', [MedidoresController::class, 'index']);
		Route::get('/medidores/busqueda', [MedidoresController::class, 'busqueda'])->name('medidores.busqueda');

Route::view('/usuarios', 'usuarios')->name('usuarios');
	//Rutas para mostrar (usuarios)
		Route::get('/usuarios', [UsuariosController::class, 'index']);

Route::view('/reportes', 'reportes')->name('reportes');

//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::view('/servicios', 'servicios')->name('servicios');
