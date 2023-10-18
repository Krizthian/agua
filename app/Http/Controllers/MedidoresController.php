<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Consumos; //Importamos el modelo de la tabla 'consumos'
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Tarifas; //Importamos el modelo de la tabla 'tarifas'
use App\Models\Cargos; //Importamos el modelo de la tabla 'cargos'

use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionPlanillaGenerada; //Importamos la propiedad para el envio de correos

class MedidoresController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        //Realizamos la obtencion de datos considerando la existencia de la tabla 'consumos'
            $consumoMedidor = Medidores::with('consumo')->paginate(10); 
        //Retornamos los valores obtenidos a la vista    
            return view('medidores', ['consumoMedidor' => $consumoMedidor]);
    }
    
    /**
     * Busqueda de Medidodres
    */

    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');       
        //Consulta Eloquent
                $query = Medidores::query();
        //Verificamos si se recibio un valor        
            if(isset($valores)){
                $query->where('numero_medidor', $valores);
            }
        //Ejecutamos la consulta
            $consumoMedidor = $query->paginate(10); //Solicitamos un maximo de valores para el paginado  

        //Retornamos los valores
            return view('medidores', compact('consumoMedidor'));              
          
    }

    /**
     * Mostramos el formulario para crear un nuevo medidor
    */
    public function create()
    {
    //Comprobamos el rol antes de devolver la vista
        if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){          
            //Realizamos la consulta para obtener la informacion de los clientes registrados
                $queryClientes = Clientes::with('medidor')->orderBy('apellido')->get();
            //Retornaremos a la vista con el formulario    
                return view('medidores.crear', compact('queryClientes')); 
    //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
        }   
    }

    /**
     * Ingresamos el medidor en la base de datos
    */
    public function store(Request $request)
    {
        //Obtenemos valores
            $id_cliente = $request->input('id_cliente');
        //Validamos los valores recibidos
        $campos_validados = request()->validate([
            'fecha_instalacion' => 'required',
            'id_cliente' => 'required',
            'ubicacion' => 'required',
            'categoria' => 'required',
            'numero_medidor' => 'required|numeric|min:0|unique:medidores,numero_medidor',
        ],[
            'ubicacion.required' => 'El campo de ubicación es obligatorio',
            'categoria.required' => 'El campo de categoría es obligatorio',
            'id_cliente.required' => 'El campo de propietario de medidor es obligatorio',
            'numero_medidor.numeric' => 'El campo de número de medidor debe contener números',
            'numero_medidor.min' => 'El valor mínimo para el campo de número de medidor es 0',
            'numero_medidor.required' => 'El campo de número de medidor es obligatorio',
            'numero_medidor.unique' => 'Este medidor ya se encuentra registrado',
        ]);

        if ($campos_validados) {
        //Insertamos los valores en la tabla
            Medidores::create([
                'id_cliente' => $id_cliente,
                'fecha_instalacion' => $campos_validados['fecha_instalacion'],
                'ubicacion' => $campos_validados['ubicacion'],
                'numero_medidor' => $campos_validados['numero_medidor'],
                'categoria_medidor' => $campos_validados['categoria'],
                'estado_medidor' => "activo",
                'resp_creacion' => session()->get('sesion')['nombres']
            ]);
        //Redireccionamos
            return redirect()->route('medidores.index')->with('resultado_creacion', 'Se ha creado el medidor correctamente'); 
        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }
   
    }

    /**
     * Redireccionar al formulario de actualización de medidor
    */

    public function edit(Medidores $consumoMedidorItem)
    {
    //Comprobamos el rol antes de devolver la vista
        if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){           
            //Obtenemos información de los clientes
                $queryClientes = Clientes::with('medidor')->orderBy('apellido')->get();
            //Devolvemos todo lo obtenido al formulario de ingreso
                return view('medidores.editar', [
                    'consumoMedidorItem' => $consumoMedidorItem,
                    'queryClientes' => $queryClientes
                ]);
    //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
        }  
    } 

    /**
     * Procesamos la actualización del medidor
    */

    public function update(Request $request, Medidores $consumoMedidorItem)
    {
        //Obtenemos valores
            $id_medidor = $consumoMedidorItem->id;
            $id_cliente = $request->input('id_cliente');
        //Validamos los valores recibidos
            $campos_validados = request()->validate([
                'ubicacion' => 'required',
                'id_cliente' => 'required',
                'categoria' => 'required'
            ],[
                'ubicacion.required' => 'El campo de ubicación es obligatorio',
                'categoria.required' => 'El campo de categoría es obligatorio',
                'id_cliente.required' => 'El campo de propietario es obligatorio',
            ]);
        //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                //Actualizamos los valores en la tabla de medidores
                    Medidores::where('id', $id_medidor)
                       ->update([
                        'id_cliente' => $id_cliente,
                        'ubicacion' => $campos_validados['ubicacion'],
                        'categoria_medidor' => $campos_validados['categoria']
                       ]);
                //Actualizamos los valores en la tabla de planilla       
                     Planillas::where('id_medidor', $id_medidor)
                       ->update([
                        'id_cliente' => $id_cliente
                       ]);
        //Redireccionamos
            return redirect()->route('medidores.index')->with('resultado_actualizacion', 'Se ha actualizado la información del medidor correctamente'); 

            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }   
    }

    /**
     * Procesar la habilitación/inhabilitación del medidor
    */
    public function inhabilitar(Medidores $consumoMedidorItem)
    {
        //Comprobamos los roles antes de devolver a la vista
           if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){  
            //Si el rol es correcto entonces comprobamos los estados
                //Comprobamos el estado del medidor y DESACTIVAMOS si se encuentra 'activo'
                    if ($consumoMedidorItem->estado_medidor == "activo") {
                        //Actualizamos el estado
                            Medidores::where('id', '=', $consumoMedidorItem->id)->update([
                                'estado_medidor' => 'inactivo'
                            ]);
                        //Redireccionamos confirmando la operación
                           return redirect()->route('medidores.index')->with('resultado_inhabilitar', 'Se ha inhabilitado el medidor correctamente');     

                //Comprobamos el estado del medidor y ACTIVAMOS si se encuentra 'inactivo'            
                      }elseif($consumoMedidorItem->estado_medidor == "inactivo"){
                        //Actualizamos el estado
                            Medidores::where('id', '=', $consumoMedidorItem->id)->update([
                                'estado_medidor' => 'activo'
                            ]);                            
                        //Redireccionamos confirmando la operación
                           return redirect()->route('medidores.index')->with('resultado_inhabilitar', 'Se ha habilitado el medidor correctamente');  
                      }

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
            }   
    }

    /**
     * Redireccionar al formulario de ingreso de consumos
    */

    public function ingresarConsumo(Medidores $consumoMedidorItem)
    {
      //Comprobamos que el medidor se encuentre activo
        if($consumoMedidorItem->estado_medidor == "activo"){
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'administrador'){            
            //Devolvemos todo lo obtenido al formulario de ingreso
                return view('medidores.consumos', [
                    'consumoMedidorItem' => $consumoMedidorItem
                ]);
        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'personal'){
                return redirect()->route('medidores.index');
            }                   
      //Redireccionamos y mostramos error si el medidor se encuentra inactivo
        }else{
            return redirect()->route('medidores.index')->with('resultado', 'El medidor seleccionado no se encuentra activo por lo que no es posible ingresar consumos'); 
        }      
    }

    /**
     * Almacenar los nuevos consumos
    */

    public function almacenarConsumo(Medidores $consumoMedidorItem)
    {
        //Obtenemos los valores desde el formulario anterior
            $id_medidor = $consumoMedidorItem->id;
            $id_cliente = $consumoMedidorItem->id_cliente;
            $consumo_actual = request('consumo_actual');
            $fecha_lectura_actual = date("Y-m-d"); //Generamos una fecha actual
            $consumo_anterior = request('consumo_anterior');
            $fecha_lectura_anterior = request('fecha_lectura_anterior');
            $responsable = request('responsable'); 
            $fecha = date("Y-m-d");
        //Validamos los valores recibidos desde el formulario anterior    
            $campos_validados = request()->validate([
                'consumo_actual' => 'required|numeric|min:0',
                'responsable' => 'required',
            ],[
                //Mensajes de error valor numerico y requerido
                    //Consumo Actual
                        'consumo_actual.numeric' => 'Se requiere un valor numérico para el campo de consumo actual',
                        'consumo_actual.min' => 'El valor mínimo para el campo de consumo actual es 0',
                        'consumo_actual.required' => 'El consumo actual es obligatorio',
                    //Responsable
                        'responsable.required' => 'El nombre del responsable es obligatorio'    

            ]);

        //Valores para la tabla de planillas
            //La factura se genera dos dias despues de la lectura
                $fecha_factura = date('Y-m-d', strtotime('+2 days', strtotime($fecha_lectura_actual)));
            //La fecha maxima de pago previo a que se suspenda el servicio es 5 dias despues de la fecha de factura    
                $fecha_maxima =  date('Y-m-d', strtotime('+5 days', strtotime($fecha_factura))); 
            //Obtenemos los rangos de tarifas desde la tabla 'tarifas'
                $tarifas = Tarifas::all();
                    $tarifa_0_15 = $tarifas->pluck('tarifa_a')->first();
                    $tarifa_16_30 = $tarifas->pluck('tarifa_b')->first();
                    $tarifa_31_60 = $tarifas->pluck('tarifa_c')->first();
                    $tarifa_61_100 = $tarifas->pluck('tarifa_d')->first();
                    $tarifa_101_300 = $tarifas->pluck('tarifa_e')->first();
                    $tarifa_301_2500 = $tarifas->pluck('tarifa_f')->first();
                    $tarifa_2501_5000 = $tarifas->pluck('tarifa_g')->first();
                    $tarifa_5000 = $tarifas->pluck('tarifa_h')->first(); 

            //Obtenemos los valores de la tabla 'cargos'        
                    $cargos = Cargos::all();
                        $alcantarillado = $cargos->pluck('alcantarillado')->first();
                        $administracion = $cargos->pluck('administracion')->first();

            //Realizamos el calculo de consumos en funcion de las tarifas e ingresarmos el valor en la variable valor_actual
               switch (true) {
                    case ($consumo_actual >= 0 && $consumo_actual <= 15):
                        $pre_valor_actual = $consumo_actual * $tarifa_0_15;
                            //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                    case ($consumo_actual >= 16 && $consumo_actual <= 30):
                        $pre_valor_actual = $consumo_actual * $tarifa_16_30;
                            //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                    case ($consumo_actual >= 31 && $consumo_actual <= 60):
                        $pre_valor_actual = $consumo_actual * $tarifa_31_60;
                             //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                    case ($consumo_actual >= 61 && $consumo_actual <= 100):
                        $pre_valor_actual = $consumo_actual * $tarifa_61_100;
                            //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                    case ($consumo_actual >= 101 && $consumo_actual <= 300):
                        $pre_valor_actual = $consumo_actual *  $tarifa_101_300;
                            //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                    case ($consumo_actual >= 301 && $consumo_actual <= 2500):
                        $pre_valor_actual = $consumo_actual * $tarifa_301_2500;
                            //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                    case ($consumo_actual >= 2501 && $consumo_actual <= 5000):
                        $pre_valor_actual = $consumo_actual * $tarifa_2501_5000;
                            //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                    case ($consumo_actual > 5000):
                        $pre_valor_actual = $consumo_actual * $tarifa_5000;
                            //Obtenemos el porcentaje del alcantarillado
                                $alcantarilladoIngresar = $pre_valor_actual * $alcantarillado;
                            //Sumamos los cargos adicionales
                                $valor_actual = $pre_valor_actual + $alcantarilladoIngresar + $administracion;
                        break;
                }

         //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                //Validamos si existe un medidor en la tabla 'consumos'
                    $id_medidorExistente = Consumos::where('id_medidor', $id_medidor)->exists();
                //Obtenemos valores de la tabla medidores
                        $medidorData = Medidores::with('cliente')
                            ->where('id', $id_medidor)
                            ->first();    
                    if ($id_medidorExistente) {
                    //Obtenemos valores de la tabla planillas
                         $planillaData = Planillas::where('id_medidor', $id_medidor)
                                        ->with('cliente') //Traemos los valores del cliente
                                        ->select('valor_actual', 'meses_mora', 'alcantarillado', 'administracion', 'fecha_maxima', 'fecha_factura')
                                        ->first();         

                        //Ingresamos valores en variables
                            $planillaValorActual = $planillaData->valor_actual;
                            $meses_mora =  $planillaData->meses_mora;
                            $alcantarillado_actual = $planillaData->alcantarillado;
                            $administracion_actual = $planillaData->administracion;

                         //Comprobamos si existe una deuda pendiente
                                /*
                                    Vamos a comprobar si existe una deuda pendiente,
                                    si ese es el caso, entonces continuaremos sumando el valor
                                    anterior en conjunto con el nuevo, por lo que el valor a pagar
                                    irá en incremento
                                */
                            if ($planillaValorActual > 0) {
                                //Sumamos valores
                                    //Deuda actual
                                        $valorDeuda = $planillaValorActual + $valor_actual;
                                    //Deuda de alcantarillado
                                        $deudaAlcantarillado = $alcantarilladoIngresar + $alcantarillado_actual;
                                    //Deuda de administracion
                                        $deudaAdministracion = $administracion + $administracion_actual;

                                 //Incrementamos los valores de meses en mora
                                 $incremento = 1;
                                 $meses_mora_incremento = $meses_mora + $incremento;                                
                                    Consumos::where('id_medidor', $id_medidor)
                                           ->update([
                                            'consumo_actual' => $consumo_actual,
                                            'fecha_lectura_actual' => $fecha_lectura_actual,
                                            'consumo_anterior' => $consumo_anterior,
                                            'fecha_lectura_anterior' => $fecha_lectura_anterior,
                                            'responsable' => $responsable
                                           ]);

                                    Planillas::where('id_medidor', $id_medidor)
                                           ->update([
                                            'valor_actual' => $valorDeuda,
                                            'alcantarillado' => $deudaAlcantarillado,
                                            'administracion' => $deudaAdministracion,
                                            'fecha_factura' => $fecha_factura,
                                            'fecha_maxima' => $fecha_maxima,
                                            'estado_servicio' => "inactivo", //Suspendemos el servicio automaticamente
                                            'resp_suspension' => "Suspensión automática", //La suspensión fue realizada por el sistema
                                            'fecha_suspension' => $fecha, //Se toma la fecha actual para registrar la suspensión
                                            'meses_mora' => $meses_mora_incremento
                                    ]);              
                         //Si no hay una deuda pendiente, continuamos con normalidad                                           
                            }elseif($planillaValorActual == 0){
                                   Consumos::where('id_medidor', $id_medidor)
                                   ->update([
                                    'consumo_actual' => $consumo_actual,
                                    'fecha_lectura_actual' => $fecha_lectura_actual,
                                    'consumo_anterior' => $consumo_anterior,
                                    'fecha_lectura_anterior' => $fecha_lectura_anterior,
                                    'responsable' => $responsable
                                   ]);

                                   Planillas::where('id_medidor', $id_medidor)
                                   ->update([
                                    'valor_actual' => $valor_actual,
                                    'alcantarillado' => $alcantarilladoIngresar,
                                    'administracion' => $administracion,
                                    'fecha_factura' => $fecha_factura,
                                    'fecha_maxima' => $fecha_maxima,
                                   ]);
                            }       
                   }else{
                    //Creamos el consumo si aun no existe
                        $consumoCreado = Consumos::create([
                        'id_medidor' => $id_medidor,
                        'consumo_actual' => $consumo_actual,
                        'fecha_lectura_actual' => $fecha_lectura_actual,
                        'consumo_anterior' => $consumo_anterior,
                        'fecha_lectura_anterior' => $fecha_lectura_anterior,
                        'responsable' => $responsable
                       ]);
                        //Obtenemos el id de consumo para la creacion de la planilla
                            $id_consumoCreado = $consumoCreado->id;
                        //Creamos la nueva planilla    
                         $planillaCreada = Planillas::create([
                            'id_cliente' => $id_cliente,
                            'id_medidor' => $id_medidor,
                            'id_consumo' => $id_consumoCreado,
                            'valor_actual' => $valor_actual,
                            'alcantarillado' => $alcantarilladoIngresar,
                            'administracion' => $administracion,                           
                            'fecha_factura' => $fecha_factura,
                            'fecha_maxima' => $fecha_maxima,
                            'estado_servicio' => "activo",
                            'resp_suspension' => "ND",
                            'fecha_suspension' => "1970-01-01",
                            'meses_mora' => 0 
                       ]);


                      /*
                        Envio de correo notificando el ingreso de la planilla
                        Este envio de correo se realiza en caso de que aún no exista otra planilla
                      */ 
                      //Comprobamos si el cliente tiene un correo electronico
                        if (!empty($medidorData->cliente->email)) {  
                        //Enviamos el correo electronico al cliente notificando el ingreso de su planilla         
                              //Introducimos valores para el correo
                                    $mensaje = [
                                        'id_planilla' => $planillaCreada->id,
                                        'numero_medidor' => $medidorData->numero_medidor,
                                        'nombre_cliente' => $medidorData->cliente->nombre,
                                        'apellido_cliente' => $medidorData->cliente->apellido,
                                        'cedula_cliente' => $medidorData->cliente->cedula,
                                        'correo_cliente' => $medidorData->cliente->email,
                                        'valor_actual' => $valor_actual,
                                        'fecha_factura' => $fecha_factura,
                                        'fecha_maxima' => $fecha_maxima,
                                    ];
                                //Enviamos el correo electronico    
                                Mail::to($mensaje['correo_cliente'])->queue(new NotificacionPlanillaGenerada($mensaje));  
                        }   



                        //Redireccionamos y devolvemos variables
                        return redirect()->route('medidores.index')->with([
                            'resultado_ingresoPlanilla' => 'Los consumos se han ingresado correctamente y se ha creado una nueva planilla',
                        ]);    
                   }


                    /*
                        Envio de correo notificando el ingreso de la planilla
                        Este envio de correo se realiza en caso de que ya exista una planilla
                    */ 
                      //Comprobamos si el cliente tiene un correo electronico
                        if (!empty($medidorData->cliente->email)) {      
                        //Enviamos el correo electronico al cliente notificando el ingreso de su planilla         
                              //Introducimos valores para el correo
                                    $mensaje = [
                                        'id_planilla' => $planillaData->id,
                                        'numero_medidor' => $medidorData->numero_medidor,
                                        'nombre_cliente' => $medidorData->cliente->nombre,
                                        'apellido_cliente' => $medidorData->cliente->apellido,
                                        'cedula_cliente' => $medidorData->cliente->cedula,
                                        'correo_cliente' => $medidorData->cliente->email,
                                        'valor_actual' => ($planillaValorActual > 0) ? $valorDeuda : $valor_actual, //Comprobamos si existe una deuda
                                        'fecha_factura' => $fecha_factura,
                                        'fecha_maxima' => $fecha_maxima,
                                    ];
                                //Enviamos el correo electronico    
                                Mail::to($mensaje['correo_cliente'])->queue(new NotificacionPlanillaGenerada($mensaje));                   
                        }  
 


          //Redireccionamos y devolvemos variables
                return redirect()->route('medidores.index')->with([
                    'resultado_ingreso' => 'Los consumos se han ingresado correctamente',
                ]);         
            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }

    }
 /**
     * Devolver resultados a la pagina de tarifas
     */
    public function mostrarTarifas()
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){
                $tarifas = Tarifas::all();
                return view('medidores.tarifas', compact('tarifas'));

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'personal'){
                return redirect()->route('medidores.index');
            }    
    }

 /**
     * Procesar actualización de tarifas
     */

    public function actualizarTarifas(Request $request)
    {
        //Realizamos la validacion de campos
            $campos_validados = request()->validate([
                'rango_0_15' => 'required|numeric|min:0',
                'rango_16_30' => 'required|numeric|min:0',
                'rango_31_60' => 'required|numeric|min:0',
                'rango_61_100' => 'required|numeric|min:0',
                'rango_101_300' => 'required|numeric|min:0',
                'rango_301_2500' => 'required|numeric|min:0',
                'rango_2501_5000' => 'required|numeric|min:0',
                'rango_5000' => 'required|numeric|min:0',
            ],[
                // Mensajes de error valor numérico
                    'rango_0_15.numeric' => 'Se requiere un valor numérico para el campo de 0-15 metros cúbicos',
                    'rango_16_30.numeric' =>'Se requiere un valor numérico para el campo de 16-30 metros cúbicos',
                    'rango_31_60.numeric' =>'Se requiere un valor numérico para el campo de 31-60 metros cúbicos',
                    'rango_61_100.numeric' =>'Se requiere un valor numérico para el campo de 61-100 metros cúbicos',
                    'rango_101_300.numeric' =>'Se requiere un valor numérico para el campo de 101-300 metros cúbicos',
                    'rango_301_2500.numeric' =>'Se requiere un valor numérico para el campo de 301-2500 metros cúbicos',
                    'rango_2501_5000.numeric' =>'Se requiere un valor numérico para el campo de 2501-5000 metros cúbicos',
                    'rango_5000.numeric' =>'Se requiere un valor numérico para el campo de 5000 en adelante metros cúbicos',
                // Mensajes de error valor requerido
                    'rango_0_15.required' => 'El campo de 0-15 metros cúbicos es obligatorio',
                    'rango_16_30.required' =>'El campo de 16-30 metros cúbicos es obligatorio',
                    'rango_31_60.required' =>'El campo de 31-60 metros cúbicos es obligatorio',
                    'rango_61_100.required' =>'El campo de 61-100 metros cúbicos es obligatorio',
                    'rango_101_300.required' =>'El campo de 101-300 metros cúbicos es obligatorio',
                    'rango_301_2500.required' =>'El campo de 301-2500 metros cúbicos es obligatorio',
                    'rango_2501_5000.required' =>'El campo de 2501-5000 metros cúbicos es obligatorio',
                    'rango_5000.required' =>'El campo de 5000 en adelante metros cúbicos es obligatorio',
                // Mensajes de error valor mínimo
                    'rango_0_15.min' => 'El valor mínimo para el campo de 0-15 metros cúbicos es 0',
                    'rango_16_30.min' => 'El valor mínimo para el campo de 16-30 metros cúbicos es 0',
                    'rango_31_60.min' => 'El valor mínimo para el campo de 31-60 metros cúbicos es 0',
                    'rango_61_100.min' => 'El valor mínimo para el campo de 61-100 metros cúbicos es 0',
                    'rango_101_300.min' => 'El valor mínimo para el campo de 101-300 metros cúbicos es 0',
                    'rango_301_2500.min' => 'El valor mínimo para el campo de 301-2500 metros cúbicos es 0',
                    'rango_2501_5000.min' => 'El valor mínimo para el campo de 2501-5000 metros cúbicos es 0',
                    'rango_5000.min' => 'El valor mínimo para el campo de 5000 en adelante metros cúbicos es 0',
            ]);
         //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                       Tarifas::where('id', '1')
                       ->update([
                        'tarifa_a' => $campos_validados['rango_0_15'],
                        'tarifa_b' => $campos_validados['rango_16_30'],
                        'tarifa_c' => $campos_validados['rango_31_60'],
                        'tarifa_d' => $campos_validados['rango_61_100'],
                        'tarifa_e' => $campos_validados['rango_101_300'],
                        'tarifa_f' => $campos_validados['rango_301_2500'],
                        'tarifa_g' => $campos_validados['rango_2501_5000'],
                        'tarifa_h' => $campos_validados['rango_5000'],
                    ]);
            return redirect()->back()->with('resultados_tarifas', 'Tarifas actualizadas correctamente.');

            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }   

    }

 /**
     * Devolver resultados a la pagina de cargos
     */
    public function mostrarCargos()
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){
                $cargos = Cargos::all();
                return view('medidores.cargos', compact('cargos'));

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'personal'){
                return redirect()->route('medidores.index');
            }    
    }
 /**
     * Procesar actualización de cargos
     */
   public function actualizarCargos(Request $request)
    {
     //Comprobamos el rol antes de devolver la vista
        if(session()->get('sesion')['rol'] == 'administrador'){
         //Validamos los campos recibidos   
            $campos_validados = request()->validate([
                'alcantarillado' => 'required|integer|min:1|max:90|regex:/^\d+(\.\d{1,2})?$/',
                'administracion' => 'required|numeric|min:0',
            ],[
                // Mensajes de error de administracion
                    'administracion.numeric' => 'El valor ingresado para el campo de cargo por administración es incorrecto',
                    'administracion.required' => 'El valor ingresado para el campo de cargo por administración es obligatorio',
                    'administracion.min' => 'El valor ingresado para el campo de cargo por administración debe ser mayor a 0',
                //Mensajes de error de alcantarillado
                    'alcantarillado.required' => 'El valor ingresado para el campo de alcantarillado es obligatorio',
                    'alcantarillado.integer' => 'El valor ingresado para el campo de alcantarillado es erróneo',
                    'alcantarillado.min' => 'El porcentaje ingresado para el campo de alcantarillado debe ser mayor a 0',
                    'alcantarillado.max' => 'El porcentaje ingresado para el campo de alcantarillado no debe ser mayor a 90',
                    'alcantarillado.regex' => 'El formato del porcentaje es incorrecto. Debe ser un número entero',
            ]);

            if ($campos_validados) {
                //Convertimos los valores de porcentaje recibidos
                    $alcantarilladoString = $request->input('alcantarillado');
                    $alcantarilladoDecimal = floatval(str_replace('%', '', $alcantarilladoString)) / 100;

                //Actualizamos los valores en la tabla    
                       Cargos::where('id', '1')
                       ->update([
                        'alcantarillado' => $alcantarilladoDecimal,
                        'administracion' => $campos_validados['administracion'],
                    ]);
                    return redirect()->back()->with('resultados_cargos', 'Cargos actualizadas correctamente.');                   

            }

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'personal'){
                return redirect()->route('medidores.index');
            }    
    } 
}