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
			Route::get('/panel', [ValoresAPagarController::class, 'index'])->name('panel.index');
		//Busqueda de valores	
			Route::get('/panel/busqueda', [ValoresAPagarController::class, 'busqueda'])->name('panel.busqueda');
		//Inhabilitar/Habilitar servicio	
			Route::get('/panel/{valoresPagarItem}/inhabilitar/', [ValoresAPagarController::class, 'inhabilitar'])->name('panel.inhabilitar');

//Rutas para mostrar (medidores)
	Route::view('/medidores', 'medidores')->name('medidores');
		//Obtencion de medidores
			Route::get('/medidores', [MedidoresController::class, 'index'])->name('medidores.index');
		//Busqueda de medidores
			Route::get('/medidores/busqueda', [MedidoresController::class, 'busqueda'])->name('medidores.busqueda');
		//Devolver el formulrio de creación de medidor
			Route::get('/medidores/crear', [MedidoresController::class, 'create'])->name('medidores.create');
			//Registrar medidor
				Route::post('/medidores', [MedidoresController::class, 'store'])->name('medidores.store');	
		//Devolver el formulrio de edición de medidor
			Route::get('/medidores/editar/{medidoresItem}', [MedidoresController::class, 'edit'])->name('medidores.editar');
			//Actualizar medidor
				Route::patch('/medidores/{medidoresItem}', [MedidoresController::class, 'update'])->name('medidores.update');
		//Eliminacion de medidores
			Route::get('/medidores/{medidoresItem}', [MedidoresController::class, 'destroy'])->name('medidores.destroy');

//Rutas para mostrar (usuarios)
	Route::view('/usuarios', 'usuarios')->name('usuarios');
		//Obtencion de usuarios
			Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
		//Busqueda de Usuarios
			Route::get('/usuarios/busqueda', [UsuariosController::class, 'busqueda'])->name('usuarios.busqueda');
		//Devolver el formulrio de creación de usuario
			Route::get('/usuarios/crear', [UsuariosController::class, 'create'])->name('usuarios.create');
			//Registrar usuario
				Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');	
		//Eliminar usuarios	
			Route::get('/usuarios/{usuariosItem}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

//Rutas para mostrar (reportes)
	Route::view('/reportes', 'reportes')->name('reportes');
		//Generacion de reportes
			Route::get('/reportes/generar', [ReportesController::class, 'generar'])->name('reportes.generar');

//Route::view('/about', 'about')->name('about');
//Route::view('/contact', 'contact')->name('contact');
//Route::view('/servicios', 'servicios')->name('servicios');
