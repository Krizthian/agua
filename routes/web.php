<?php

use Illuminate\Support\Facades\Route;

//Definimos los controladores creados
	use App\Http\Controllers\PlanillasController; //Controlador de Consulta
	use App\Http\Controllers\PagosController; //Controlador de Pagos
	use App\Http\Controllers\MedidoresController; //Controlador de Medidores
	use App\Http\Controllers\ClientesController; //Controlador de Clientes
	use App\Http\Controllers\LoginController; //Controlador de Login
	use App\Http\Controllers\UsuariosController; //Controlador de Usuarios
	use App\Http\Controllers\ReportesController; //Controlador de Reportes
	use App\Http\Controllers\MantenimientosController; //Controlador de Mantenimientos
	use App\Http\Controllers\ReclamosController; //Controlador de Reclamos
	use App\Http\Controllers\PanelController; //Controlador de Panel

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
		Route::get('/consulta', [PlanillasController::class, 'indexCiudadano'])->name('consulta.index');
	//Detalles de planilla
		Route::get('/consulta/planilla/{pagosConsultaItem}', [PlanillasController::class, 'mostrarPlanillaCiudadano'])->name('consulta.show');	


//Calculadora
	Route::view('/calculadora', 'calculadora')->name('calculadora');
		Route::get('/calculadora', [PlanillasController::class, 'calculadoraFormulario'])->name('calculadora.index');
		//Calculamos valores a pagar
			Route::post('/calculadora/calcular', [PlanillasController::class, 'calcularValores'])->name('calculadora.calcular');

//Login
	Route::view('/login', 'login')->name('login');
		//Ruta para proceso de Login
			Route::post('/login', [LoginController::class, 'login']);
		//Ruta para proceso de recuperación de contraseña	
			Route::get('/login/recuperar', [LoginController::class, 'recuperarFormulario'])->name('recuperar');
				//Enviar formulario de recuperación
				Route::post('/login/recuperar', [LoginController::class, 'recuperarProceso'])->name('login.RecuperarProcesar');
				//Formulario para la actualizacion de contraseña
				Route::get('/login/recuperar/actualizar', [LoginController::class, 'validarToken'])->name('validarToken');
				//Proceso para actualizacion de contraseña
				Route::post('/login/recuperar/actualizar/', [LoginController::class, 'recuperacionUpdate'])->name('login.update');
		//Ruta para hacer un logout
			Route::post('/salir', [LoginController::class, 'salir'])->name('salir');

/*Rutas para el personal del Municipio*/

//Rutas para mostrar (panel de gestión)
	Route::view('/panel', 'panel')->name('panel');
		Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');

//Rutas para mostrar (planillas)
	Route::view('/planillas', 'planillas')->name('planillas');
		//Obtencion de valores
			Route::get('/planillas', [PlanillasController::class, 'index'])->name('planillas.index');
		//Detalles de planilla
			Route::get('/planillas/planilla/{valoresPagarItem}', [PlanillasController::class, 'show'])->name('planillas.show');	
		//Busqueda de valores	
			Route::get('/planillas/busqueda', [PlanillasController::class, 'busqueda'])->name('planillas.busqueda');
		//Devolver el formulario de ingreso de pago
			Route::get('/planillas/ingresar/{valoresPagarItem}', [PlanillasController::class, 'edit'])->name('planillas.ingresar');
			//Ingresar pago
				Route::patch('/planillas/{valoresPagarItem}', [PlanillasController::class, 'update'])->name('planillas.update');
		//Notificar valores a pagar
			Route::post('planillas/notificar', [PlanillasController::class, 'notificar'])->name('planillas.notificar');			
		//Inhabilitar/Habilitar servicio	
			Route::get('/planillas/{valoresPagarItem}/inhabilitar/', [PlanillasController::class, 'inhabilitar'])->name('planillas.inhabilitar');

//Rutas para mostrar (actualizacion de tarifas)
		Route::view('/tarifas', 'tarifas')->name('tarifas');
			//Obtencion de valores
				Route::get('/tarifas', [MedidoresController::class, 'mostrarTarifas'])->name('tarifas.index');
			//Actualizar medidor
				Route::patch('/tarifas/actualizar/', [MedidoresController::class, 'actualizarTarifas'])->name('tarifas.update');	

//Rutas para mostrar (actualizacion de cargos)
		Route::view('/cargos', 'cargos')->name('cargos');
			//Obtencion de valores
				Route::get('/cargos', [MedidoresController::class, 'mostrarCargos'])->name('cargos.index');
			//Actualizar medidor
				Route::patch('/cargos/actualizar/', [MedidoresController::class, 'actualizarCargos'])->name('cargos.update');	

//Rutas para mostrar (historial de pagos)
	Route::view('/pagos', 'pagos')->name('pagos');
			//Obtencion de valores
			Route::get('/pagos', [PagosController::class, 'index'])->name('pagos.index');
			//Busqueda de valores	
			Route::get('/pagos/busqueda', [PagosController::class, 'busqueda'])->name('pagos.busqueda');
			//Mostrar recibo
			Route::get('/pagos/recibo/{pagosItem}', [PagosController::class, 'mostrarRecibo'])->name('pagos.show');

//Rutas para mostrar (medidores)
	Route::view('/medidores', 'medidores')->name('medidores');
		//Obtencion de medidores
			Route::get('/medidores', [MedidoresController::class, 'index'])->name('medidores.index');
		//Busqueda de medidores
			Route::get('/medidores/busqueda', [MedidoresController::class, 'busqueda'])->name('medidores.busqueda');
		//Devolver el formulario de ingreso de consumos
			Route::get('/medidores/consumos/ingresar/{consumoMedidorItem}', [MedidoresController::class, 'ingresarConsumo'])->name('consumos.ingresarConsumo');
				//Ingresar consumo
				Route::patch('/medidores/consumos/{consumoMedidorItem}', [MedidoresController::class, 'almacenarConsumo'])->name('consumos.almacenarConsumo');
		//Devolver el formulario de creación de medidor
			Route::get('/medidores/crear', [MedidoresController::class, 'create'])->name('medidores.create');
			//Registrar medidor
				Route::post('/medidores/registrar', [MedidoresController::class, 'store'])->name('medidores.store');	
		//Devolver el formulario de edición de medidor
			Route::get('/medidores/editar/{consumoMedidorItem}', [MedidoresController::class, 'edit'])->name('medidores.edit');
			//Actualizar medidor
				Route::patch('/medidores/{consumoMedidorItem}', [MedidoresController::class, 'update'])->name('medidores.update');		
		//Inhabilitar/Habilitar medidores	
			Route::get('/medidores/inhabilitar/{consumoMedidorItem}', [MedidoresController::class, 'inhabilitar'])->name('medidores.inhabilitar');

//Rutas para mostrar (mantenimientos)
	Route::view('/mantenimientos', 'mantenimientos')->name('mantenimientos');
		//Obtencion de valores
			Route::get('/mantenimientos', [MantenimientosController::class, 'index'])->name('mantenimientos.index');				
		//Devolver el formulario de solicitud de mantenimiento
			Route::get('/medidores/mantenimiento/{consumoMedidorItem}', [MantenimientosController::class, 'create'])->name('mantenimientos.create');
			//Registrar mantenimiento
				Route::post('/medidores/mantenimiento/{consumoMedidorItem}', [MantenimientosController::class, 'store'])->name('mantenimientos.store');		
		//Busqueda de mantenimientos
			Route::get('/medidores/mantenimientos/busqueda', [MantenimientosController::class, 'busqueda'])->name('mantenimientos.busqueda');
		//Actualizar estado de solicitud	
			Route::get('/medidores/mantenimientos/{mantenimientosItem}/actualizar/', [MantenimientosController::class, 'actualizarEstado'])->name('mantenimientos.actualizarEstado');
		//Devolver el formulario de edición de solicitud de mantenimiento
			Route::get('/medidores/mantenimientos/editar/{mantenimientosItem}', [MantenimientosController::class, 'edit'])->name('mantenimientos.edit');
			//Actualizar solicitud de mantenimiento
				Route::patch('/medidores/mantenimientos/editar/{mantenimientosItem}', [MantenimientosController::class, 'update'])->name('mantenimientos.update');				

//Rutas para mostrar (reclamos)
	Route::view('/reclamos', 'reclamos')->name('reclamos');
		//Obtencion de valores
			Route::get('/reclamos', [ReclamosController::class, 'index'])->name('reclamos.index');
		//Devolver informacion completa de reclamos
			Route::get('/reclamos/reclamo/{reclamosItem}', [ReclamosController::class, 'show'])->name('reclamos.show');	
		//Devolver el formulario de ingreso de reclamo
			Route::get('/reclamos/crear/{pagosConsultaItem}', [ReclamosController::class, 'create'])->name('reclamos.create');
		//Busqueda de mantenimientos
			Route::get('/reclamos/busqueda', [ReclamosController::class, 'busqueda'])->name('reclamos.busqueda');
			//Registrar reclamo
				Route::post('/reclamos/crear/{pagosConsultaItem}', [ReclamosController::class, 'store'])->name('reclamos.store');
		//Actualizar estado de solicitud	
			Route::get('/reclamos/actualizar/{reclamosItem}', [ReclamosController::class, 'actualizarEstado'])->name('reclamos.actualizarEstado');
		//Eliminar reclamos	
			Route::get('/reclamos/eliminar/{reclamosItem}', [ReclamosController::class, 'destroy'])->name('reclamos.destroy');

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

//Rutas para mostrar (usuarios)
	Route::view('/usuarios', 'usuarios')->name('usuarios');
		//Actualizar contraseña	
			Route::get('/usuarios/actualizar', [UsuariosController::class, 'actualizarPasswordForm'])->name('usuarios.actualizarPassword');
			//Procesar actualización de contraseña
				Route::post('/usuarios/actualizar', [UsuariosController::class, 'actualizarPassword'])->name('actualizarPassword');
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
		//Inhabilitar/Habilitar usuarios	
			Route::get('/usuarios/{usuariosItem}', [UsuariosController::class, 'inhabilitar'])->name('usuarios.inhabilitar');

//Rutas para mostrar (reportes)
	Route::view('/reportes', 'reportes')->name('reportes');
		//Generacion de reportes
			Route::get('/reportes/generar', [ReportesController::class, 'generar'])->name('reportes.generar');
