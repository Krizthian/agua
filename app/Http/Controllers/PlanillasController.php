<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Consumos; //Importamos el modelo de la tabla 'consumos'
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'
use App\Models\Tarifas; //Importamos el modelo de la tabla 'pagos'

use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionPlanilla; //Importamos la propiedad para el envio de correos

class PlanillasController extends Controller
{
    /**
     * Devolver resultados al Panel
     */
    public function index()
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){
                $valores_pagar = Planillas::with(['cliente', 'medidor', 'consumo'])->paginate(10);
                return view('panel', compact('valores_pagar'));

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
            }    
    }

        /**
        * Devolver formulario de calculadora
        */

        public function calculadoraFormulario()
        {
           //Obtenemos las tarifas desde la base de datos 
            $tarifas = Tarifas::all();  
           //Retornamos a la vista con los valores     
            return view('calculadora', compact('tarifas'));
        }


        public function calcularValores(Request $request)
        {
            //Obtenemos los valoes desde el formulario anterior
              $campos_validados = request()->validate([
                    'valor' => 'required|numeric|min:0',
                ],[
                    //Mensaje de error
                        'valor.numeric' => 'Se requiere un valor numérico para el campo de metros cúbicos',
                        'valor.min' => 'El valor mínimo para el campo de metros cúbicos es 0',
                        'valor.required' => 'El campo de metros cúbicos es obligatorio'
                ]);
            //Obtenemos los valores de las tarifas
                     $tarifas = Tarifas::all();
                        $tarifa_0_15 = $tarifas->pluck('tarifa_a')->first();
                        $tarifa_16_30 = $tarifas->pluck('tarifa_b')->first();
                        $tarifa_31_60 = $tarifas->pluck('tarifa_c')->first();
                        $tarifa_61_100 = $tarifas->pluck('tarifa_d')->first();
                        $tarifa_101_300 = $tarifas->pluck('tarifa_e')->first();
                        $tarifa_301_2500 = $tarifas->pluck('tarifa_f')->first();
                        $tarifa_2501_5000 = $tarifas->pluck('tarifa_g')->first();
                        $tarifa_5000 = $tarifas->pluck('tarifa_h')->first(); 

             if($campos_validados){
                //Creamos variables temporales
                        $valor_actual = 0;
                        $costo_agua = 0;
                //Realizamos el calculo de consumos en funcion de las tarifas e ingresarmos el valor en la variable valor_actual
                   switch (true) {
                        case ($campos_validados['valor'] >= 0 && $campos_validados['valor'] <= 15):
                            $valor_actual = $campos_validados['valor'] * $tarifa_0_15;
                            $costo_agua = $tarifa_0_15;
                            break;
                        case ($campos_validados['valor'] >= 16 && $campos_validados['valor'] <= 30):
                            $valor_actual = $campos_validados['valor'] * $tarifa_16_30;
                            $costo_agua = $tarifa_16_30;
                            break;
                        case ($campos_validados['valor'] >= 31 && $campos_validados['valor'] <= 60):
                            $valor_actual = $campos_validados['valor'] * $tarifa_31_60;
                            $costo_agua = $tarifa_31_60;
                            break;
                        case ($campos_validados['valor'] >= 61 && $campos_validados['valor'] <= 100):
                            $valor_actual = $campos_validados['valor'] * $tarifa_61_100;
                            $costo_agua = $tarifa_61_100;
                            break;
                        case ($campos_validados['valor'] >= 101 && $campos_validados['valor'] <= 300):
                            $valor_actual = $campos_validados['valor'] *  $tarifa_101_300;
                            $costo_agua = $tarifa_101_300;
                            break;
                        case ($campos_validados['valor'] >= 301 && $campos_validados['valor'] <= 2500):
                            $valor_actual = $campos_validados['valor'] * $tarifa_301_2500;
                            $costo_agua = $tarifa_301_2500;
                            break;
                        case ($campos_validados['valor'] >= 2501 && $campos_validados['valor'] <= 5000):
                            $valor_actual = $campos_validados['valor'] * $tarifa_2501_5000;
                            $costo_agua = $tarifa_2501_5000;
                            break;
                        case ($campos_validados['valor'] > 5000):
                            $valor_actual = $campos_validados['valor'] * $tarifa_5000;
                            $costo_agua = $tarifa_5000;
                            break;
                    }
                        return redirect()->back()->withInput()->with([
                            'valor_actual' => $valor_actual,
                            'costo_agua' => $costo_agua
                        ]);

                   }else{
                     return redirect()->back()->withErrors($campos_validados)->withInput();
                   }     

        }
 
    /**
     * Devolver resultados al Home (Solicitud de Ciudadano)
     */
    public function indexCiudadano(Request $request){
        //Validamos los campos recibidos
                $campos_validados = request()->validate([
                    'medidor_cedula' => 'required|numeric',
                ],[
        //Mensajes de error
                    'medidor_cedula.required' => 'El campo de valores es obligatorio',
                    'medidor_cedula.numeric' => 'El campo de valores debe ser un número',
             ]);

    // Obtener los valores pasados por el formulario
        $medidor_cedula = $campos_validados['medidor_cedula'];

    // Consulta Eloquent
        $query = Planillas::with(['cliente', 'medidor', 'consumo']);

    // Verificar si se ha proporcionado "numero_medidor" o "cedula" y agregar condiciones a la consulta
        if(isset($medidor_cedula)){
            $query->where(function ($q) use ($medidor_cedula) {
                $q->whereHas('medidor', function ($subQuery) use ($medidor_cedula) {
                    $subQuery->where('numero_medidor', $medidor_cedula);
                })
                ->orWhereHas('cliente', function ($subQuery) use ($medidor_cedula) {
                    $subQuery->where('cedula', $medidor_cedula);
                })
                 ->orWhere(function($subQuery) use ($medidor_cedula){
                    $subQuery->where('id', $medidor_cedula);
                });
            });
    // Ejecutar la consulta y obtener los resultados
        $resultados = $query->paginate(10);

    // Retornar los resultados
        return view('/home', compact('resultados', 'medidor_cedula'));
      //Si no se ha pasado ningun valor, redireccionamos al inicio                  
        }else{
        // Redireccionamos
            return redirect('/');
        }                
    }

    /**
     * Busqueda de valores en panel de gestión
     */
    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');

        //Consulta Eloquent
            $query = Planillas::with(['cliente', 'medidor', 'consumo']);

        //Verificamos si se recibio un valor y realizamos la busqueda
            if(isset($valores)){
                $query->where(function ($q) use ($valores) {
                    $q->whereHas('medidor', function ($subQuery) use ($valores) {
                        $subQuery->where('numero_medidor', $valores);
                    })
                    ->orWhereHas('cliente', function ($subQuery) use ($valores) {
                        $subQuery->where('cedula', $valores)
                                  ->orWhere('apellido', $valores);
                    })              
                    ->orWhere(function($subQuery) use ($valores){
                        $subQuery->where('id', $valores);
                    }); 
                });
            }

         //Ejecutamos la consulta
            $valores_pagar = $query->paginate(10); //Solicitamos un maximo de valores para el paginado

         //Retornamos los valores
            return view('panel', compact('valores_pagar'));   
    }

    /**
    * Enviar la alerta de pago pendiente al cliente
    */
    public function notificar(Request $request)
    {
        //Validamos valores
            $mensaje = request()->validate([
                'cliente_planilla_id' => 'required',
                'cliente_planilla_valorActual' => 'required',
                'cliente_planilla_fechaFactura' => 'required',
                'cliente_planilla_fechaMaxima' => 'required',
                'cliente_medidor' => 'required',
                'cliente_cedula' => 'required',
                'cliente_nombre' => 'required',
                'cliente_apellido' => 'required',
                'cliente_email' => 'required'
            ]);

        //Antes de enviar el correo verificamos si hay valores a notificar
            if ($request->input('cliente_planilla_valorActual') > 0) {
                //Enviamos el correo electronico    
                Mail::to($request->input('cliente_email'))->queue(new NotificacionPlanilla($mensaje));
                    //Redireccionamos de vuelta a la vista
                    return redirect()->route('panel.index')->with('resultado_notificacion', 'Notificación enviada');        
                }else{
                    //Redireccionamos de vuelta a la vista
                    return redirect()->route('panel.index')->with('resultado_validacionNotificacion', 'No se puede notificar'); 
                }
    }

    /**
     * Habilitar o Inhabilitar el servicio del agua
     */
    public function inhabilitar (Planillas $valoresPagarItem)
    {
        //Comprobamos el estado del servicio
            //Desactivamos el servicio si este se encuentra 'inactivo'
                if ($valoresPagarItem->estado_servicio == "activo") {
                    Planillas::where('id', '=', $valoresPagarItem->id)->update(['estado_servicio' => 'inactivo']);
                    return redirect()->back()->with('resultado', 'Se ha suspendido el servicio al medidor '. ''. $valoresPagarItem->numero_medidor); //Devolvemos el mensaje de resultados a la vista 'panel'
            //Reactivamos el servicio si este se encuentra 'activo'
                }elseif ($valoresPagarItem->estado_servicio == "inactivo") {
                    Planillas::where('id', '=', $valoresPagarItem->id)->update(['estado_servicio' => 'activo']);
                    return redirect()->back()->with('resultado', 'Se ha reactivado el servicio al medidor '. ''. $valoresPagarItem->numero_medidor); //Devolvemos el mensaje de resultados a la vista 'panel'
                }
    }

    /**
     * Mostramos el formulario para ingresar un pago
    */
    public function edit(Planillas $valoresPagarItem)
    {
        $valores_pagar = Planillas::with(['cliente', 'medidor', 'consumo'])
            ->whereHas('cliente', function ($query) use ($valoresPagarItem) {
                $query->where('id_cliente', $valoresPagarItem);
            })
            ->whereHas('medidor', function ($query) use ($valoresPagarItem) {
                $query->where('id_medidor', $valoresPagarItem);
            })
            ->whereHas('consumo', function ($query) use ($valoresPagarItem) {
                $query->where('id_consumo', $valoresPagarItem);
            })
            ->get();
    //Comprobamos si el medidor seleccionado tiene valores pendientes
        if ($valoresPagarItem->valor_actual > 0) {
            //Retornaremos a la vista con el formulario si existen valores pendientes
                return view('planillas.ingresar', [
                    'valoresPagarItem' => $valoresPagarItem,
                    'valores_pagar' => $valores_pagar
                ]);
            }
        //En caso de que no haya valores pendientes notificamos al usuario    
            return redirect()->route('panel.index')->with([
                'resultado_comprobacion' => 'El medidor seleccionado no tiene valores pendientes',
                'medidor_pagado' => $valoresPagarItem->numero_medidor,
            ]);

    }

    /**
     * Actualizamos el valor en la base de datos.
     */
    public function update(Planillas $valoresPagarItem)
    {
        //Obtenemos las variables enviadas en el formulario
            $valor_nuevo = request('valor_nuevo');
            $forma_pago = request('forma_pago');
            $fecha = date("Y-m-d");
       //Validamos los valores recibidos desde el formulario anterior
            $campos_validados = request()->validate([
                'valor_nuevo' => 'required|numeric|min:0',
                'forma_pago' => 'required',
            ],[
                //Mensaje de error
                    'valor_nuevo.numeric' => 'Se requiere un valor numérico para el campo de valor a pagar',
                    'valor_nuevo.min' => 'El valor mínimo para el campo de valor a pagar es 0',
                    'forma_pago.required' => 'La forma de pago es obligatoria',
                    'valor_nuevo.required' => 'El campo de valor a pagar es obligatorio'
            ]);     

        //Realizamos la operacion matematica para restar valores
            //Restamos los valores existentes en la base de datos menos los recibidos en el formulario
                $valorFinalIngresar = $valoresPagarItem->valor_actual - $valor_nuevo;

        //Si los campos han sido validados, realizamos la consulta
        if ($campos_validados) {
            //Realizamos la consulta Eloquent para la actualizacion de valores en 'Planillas'
                Planillas::where('id_medidor', $valoresPagarItem->medidor->id)
                     ->update([
                            'valor_actual' => $valorFinalIngresar,
                        ]);
            //Si la deuda es completamente liquidada, se reinicia el contador de meses en mora         
               if ($valoresPagarItem->valor_actual == $valor_nuevo) {
                   Planillas::where('id_medidor', $valoresPagarItem->medidor->id)
                     ->update(['meses_mora' => 0]);
                }     
            //Realizamos la consulta Eloquent para la actualizacion de valores en 'Pagos'
                Pagos::where('id_cliente', $valoresPagarItem->cliente->id)
                     ->create([
                            'id_cliente' => $valoresPagarItem->cliente->id,
                            'id_planilla' => $valoresPagarItem->id,
                            'valor_pagado' => $valor_nuevo,
                            'valor_restante' => $valorFinalIngresar,
                            'fecha_pago' => $fecha,
                            'forma_pago' => $forma_pago
                        ]);

            //Redireccionamos y devolvemos variables
                return redirect()->route('panel.index')->with([
                    'resultado_ingreso' => 'El pago se ha ingresado correctamente',
                    'medidor_pagado' => $valoresPagarItem->numero_medidor,
                    'valor_pagado' => $valor_nuevo,
                ]);         
        
        //Si no se ha realizado la validación correctamente, regresamos al formulario anterior        
        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }

    }
}