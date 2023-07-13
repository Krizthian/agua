<?php

use Illuminate\Support\Facades\Route;

//Definimos los controladores creados
use App\Http\Controllers\ValoresAPagarController; //Controlador de consulta (personal)
use App\Http\Controllers\MedidoresController; //Controlador de Medidores
use App\Http\Controllers\ConsultaClienteController; //Controlador de consulta (ciudadano)
use App\Http\Controllers\LoginController; //Controlador de Login
use App\Http\Controllers\SalirController; //Controlador de Logout
use App\Http\Controllers\UsuariosController; //Controlador de Usuarios
use App\Http\Controllers\ReportesController; //Controlador de Reportes

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

//Rutas para mostrar (valores a pagar)
	Route::view('/panel', 'panel')->name('panel');
		//Obtencion de valores
			Route::get('/panel', [ValoresAPagarController::class, 'index']);
		//Busqueda de valores	
			Route::get('/panel/busqueda', [ValoresAPagarController::class, 'busqueda'])->name('panel.busqueda');

//Rutas para mostrar (medidores)
	Route::view('/medidores', 'medidores')->name('medidores');
		//Obtencion de medidores
			Route::get('/medidores', [MedidoresController::class, 'index'])->name('medidores.index');
		//Busqueda de medidores
			Route::get('/medidores/busqueda', [MedidoresController::class, 'busqueda'])->name('medidores.busqueda');
		//Eliminacion de medidores
			Route::delete('/medidores/{medidoresItem}', [MedidoresController::class, 'destroy'])->name('medidores.destroy');

//Rutas para mostrar (usuarios)
	Route::view('/usuarios', 'usuarios')->name('usuarios');
		//Obtencion de usuarios
			Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
		//Busqueda de Usuarios
			Route::get('/usuarios/busqueda', [UsuariosController::class, 'busqueda'])->name('usuarios.busqueda');
		//Eliminar usuarios	
			Route::delete('/usuarios/{usuariosItem}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

//Rutas para mostrar (reportes)
	Route::view('/reportes', 'reportes')->name('reportes');
		//Generacion de reportes
			Route::get('/reportes/generar', [ReportesController::class, 'generar'])->name('reportes.generar');

//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::view('/servicios', 'servicios')->name('servicios');
