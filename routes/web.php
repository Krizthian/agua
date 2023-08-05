<?php

use Illuminate\Support\Facades\Route;

//Definimos los controladores creados
use App\Http\Controllers\ValoresAPagarController; //Controlador de Consulta
use App\Http\Controllers\PagosController; //Controlador de Pagos
use App\Http\Controllers\MedidoresController; //Controlador de Medidores
use App\Http\Controllers\ConsumosController; //Controlador de Consumos
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
		//Inhabilitar/Habilitar servicio	
			Route::get('/panel/{valoresPagarItem}/inhabilitar/', [ValoresAPagarController::class, 'inhabilitar'])->name('panel.inhabilitar');

//Rutas para mostrar (historial de pagos)
	Route::view('/pagos', 'pagos')->name('pagos');
			//Obtencion de valores
			Route::get('/pagos', [PagosController::class, 'index'])->name('pagos.index');
			//Busqueda de valores	
			Route::get('/pagos/busqueda', [PagosController::class, 'busqueda'])->name('pagos.busqueda');

//Rutas para mostrar (medidores)
	Route::view('/medidores', 'medidores')->name('medidores');
		//Obtencion de medidores
			Route::get('/medidores', [MedidoresController::class, 'index'])->name('medidores.index');
		//Busqueda de medidores
			Route::get('/medidores/busqueda', [MedidoresController::class, 'busqueda'])->name('medidores.busqueda');
		//Devolver el formulario de ingreso de consumos
			Route::get('/panel/medidores/consumos/{consumoMedidorItem}', [MedidoresController::class, 'ingresarConsumo'])->name('consumos.ingresarConsumo');
				//Ingresar pago
				Route::patch('/panel/medidores/consumos/{consumoMedidorItem}', [MedidoresController::class, 'almacenarConsumo'])->name('consumos.almacenarConsumo');


//Rutas para mostrar (consumos)
	Route::view('/consumos', 'consumos')->name('consumos');
		//Obtencion de consumos
			Route::get('/consumos', [ConsumosController::class, 'index'])->name('consumos.index');
		//Busqueda de consumos
			Route::get('/consumos/busqueda', [ConsumosController::class, 'busqueda'])->name('consumos.busqueda');

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
		//Solicitar listado de medidores asociado a clientes
			Route::get('/clientes/listar/{clientesItem}', [ClientesController::class, 'listar'])->name('clientes.listar');
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
