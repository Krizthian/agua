<?php

use Illuminate\Support\Facades\Route;

//Definimos los controladores creados
use App\Http\Controllers\ValoresAPagarController; //Controlador de consulta
use App\Http\Controllers\ClientesController; //Controlador de Clientes
use App\Http\Controllers\LoginController; //Controlador de Login
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
		Route::get('/consulta', [ValoresAPagarController::class, 'indexCiudadano'])->name('consulta.index');

//Login
	Route::view('/login', 'login')->name('login');
		//Ruta para proceso de Login
			Route::post('/login', [LoginController::class, 'login']);
		//Ruta para hacer un logout
			Route::post('/salir', [LoginController::class, 'salir'])->name('salir');

/*Rutas para el personal del Municipio*/

//Rutas para mostrar (valores a pagar)
	Route::view('/panel', 'panel')->name('panel');
		//Obtencion de valores
			Route::get('/panel', [ValoresAPagarController::class, 'index'])->name('panel.index');
		//Busqueda de valores	
			Route::get('/panel/busqueda', [ValoresAPagarController::class, 'busqueda'])->name('panel.busqueda');
		//Devolver el formulario de creación de planilla
			Route::get('/panel/planillas/crear', [ValoresAPagarController::class, 'create'])->name('planillas.crear');
			//Registrar planilla
				Route::post('/panel', [ValoresAPagarController::class, 'store'])->name('planillas.store');	
		//Devolver el formulario de ingreso de pago
			Route::get('/panel/planillas/{valoresPagarItem}', [ValoresAPagarController::class, 'edit'])->name('planillas.ingresar');
			//Ingresar pago
				Route::patch('/panel/{valoresPagarItem}', [ValoresAPagarController::class, 'update'])->name('planillas.update');
		//Devolver el formulario de actualizacion de planilla
			Route::get('/panel/planillas/facturar/{valoresPagarItem}', [ValoresAPagarController::class, 'actualizar'])->name('planillas.actualizar');
			//Facturar
				Route::patch('/panel/facturar/{valoresPagarItem}', [ValoresAPagarController::class, 'bill'])->name('planillas.bill');			
		//Inhabilitar/Habilitar servicio	
			Route::get('/panel/{valoresPagarItem}/inhabilitar/', [ValoresAPagarController::class, 'inhabilitar'])->name('panel.inhabilitar');

//Rutas para mostrar (clientes)
	Route::view('/clientes', 'clientes')->name('clientes');
		//Obtencion de clientes
			Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
		//Busqueda de clientes
			Route::get('/clientes/busqueda', [ClientesController::class, 'busqueda'])->name('clientes.busqueda');
		//Devolver el formulario de creación de cliente
			Route::get('/clientes/crear', [ClientesController::class, 'create'])->name('clientes.create');
			//Registrar cliente
				Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');	
		//Devolver el formulario de edición de cliente
			Route::get('/clientes/editar/{clientesItem}', [ClientesController::class, 'edit'])->name('clientes.editar');
			//Actualizar cliente
				Route::patch('/clientes/{clientesItem}', [ClientesController::class, 'update'])->name('clientes.update');
		//Eliminacion de clientes
			Route::get('/clientes/{clientesItem}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

//Rutas para mostrar (usuarios)
	Route::view('/usuarios', 'usuarios')->name('usuarios');
		//Obtencion de usuarios
			Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
		//Busqueda de Usuarios
			Route::get('/usuarios/busqueda', [UsuariosController::class, 'busqueda'])->name('usuarios.busqueda');
		//Devolver el formulario de creación de usuario
			Route::get('/usuarios/crear', [UsuariosController::class, 'create'])->name('usuarios.create');
			//Registrar usuario
				Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');	
		//Devolver el formulario de edición de usuario
			Route::get('/usuarios/editar/{usuariosItem}', [UsuariosController::class, 'edit'])->name('usuarios.editar');
			//Actualizar usuario
				Route::patch('/usuarios/{usuariosItem}', [UsuariosController::class, 'update'])->name('usuarios.update');		
		//Eliminar usuarios	
			Route::get('/usuarios/{usuariosItem}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

//Rutas para mostrar (reportes)
	Route::view('/reportes', 'reportes')->name('reportes');
		//Generacion de reportes
			Route::get('/reportes/generar', [ReportesController::class, 'generar'])->name('reportes.generar');
