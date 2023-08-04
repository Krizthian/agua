<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Consumos; //Importamos el modelo de la tabla 'consumos'

class ValoresAPagarController extends Controller
{
    /**
     * Devolver resultados al Panel
     */
    public function index()
    {
        $valores_pagar = Planillas::with(['cliente', 'medidor', 'consumo'])->paginate(10);
        return view('panel', compact('valores_pagar'));
    }

    /**
     * Devolver resultados al Home (Solicitud de Ciudadano)
     */
    public function indexCiudadano(Request $request){

    // Obtener los valores pasados por el formulario
        $medidor_cedula = $request->input('medidor_cedula');

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
     * Mostramos el formulario para crear una planilla
     */
    public function create(){
        //Realizamos la consulta para obtener la informacion de los clientes registrados
            $queryMedidores = Medidores::with('cliente')->get();
        //Devolvemos la informacion al formulario de creación     
            return view ('planillas.crear', compact('queryMedidores'));
    }    

    /**
     * Guardamos la planilla creada
     */
    public function store(Request $request){
     //Validamos los valores recibidos
        $campos_validados = request()->validate([
            'valor_actual' => 'required|numeric',
            'fecha_factura' => 'required|date',
            'fecha_maxima' => 'required|date',
            'numero_medidor' => 'required',
        ],[
            'numero_medidor.required' => 'El numero de medidor es un campo obligatorio',
            'valor_actual.numeric' => 'Se requiere un valor numerico para el campo de valor actual',
            'fecha_factura.required' => 'Se requiere una fecha para el campo de fecha de factura ',
            'fecha_maxima.required' => 'Se requiere una fecha para el campo de fecha maxima de pago ',
        ]);

       if ($campos_validados) {          
            //Obtendremos todos los valores de la tabla clientes asociados al numero de medidor pasado
                //Obtenemos valores con el numero de medidor recibido       
                    $queryMedidorItem = Medidores::query()
                        ->where('numero_medidor', $campos_validados['numero_medidor'])
                        ->first();

                //Buscamos el consumo asociado al medidor
                        $queryConsumoItem = Consumos::query()
                            ->where('id_medidor', $queryMedidorItem->id) 
                            ->first();       

                //Ingresamos los datos en la tabla de Planillas
                    Planillas::create([
                        'id_cliente' => $queryMedidorItem->id_cliente,
                        'id_medidor' => $queryMedidorItem->id,
                        'id_consumo' => $queryConsumoItem->id,
                        'valor_actual' => $campos_validados['valor_actual'],
                        'fecha_factura' => $campos_validados['fecha_factura'],
                        'fecha_maxima' => $campos_validados['fecha_maxima'],
                        'estado_servicio' => "activo",

                    ]);
                //Redireccionamos y devolvemos variables
                return redirect()->route('panel.index')->with([
                    'resultado_creacion' => 'Se ha creado la nueva planilla correctamente',
                ]);         
        
                //Si no se ha realizado la validación correctamente, regresamos al formulario anterior        
                }else{
                    return redirect()->back()->withErrors($campos_validados)->withInput();
                }

    }

    /**
     * Mostramos el formulario para actualizar una planilla
    */
    public function actualizar(Planillas $valoresPagarItem){

        //Devolvemos la informacion al formulario de facturacion     
        return view('planillas.facturar', [
                    'valoresPagarItem' => $valoresPagarItem
        ]);

    }   

    /**
     * Actualizamos los valores en la planilla
    */
    public function bill(Planillas $valoresPagarItem){
        //Obtenemos las variables enviadas en el formulario
            $cedula = request('cedula');
            $nombre = request('nombre');
            $apellido = request('apellido');
            $valor_pagar = request('valor_pagar');
            $fecha_factura = request('fecha_factura');
            $fecha_maxima = request('fecha_maxima');
            $meses_mora = request('meses_mora');

       //Validamos los valores recibidos desde el formulario anterior
            $campos_validados = request()->validate([
                'cedula' => 'required|numeric',
                'nombre' => 'required|string|regex:/^[A-Za-z\s]+$/',
                'apellido' => 'required|string|regex:/^[A-Za-z\s]+$/',
                'valor_pagar' => 'required|numeric',
                'fecha_factura' => 'required|date_format:Y-m-d',
                'fecha_maxima' => 'required|date_format:Y-m-d',
                'meses_mora' => 'required|numeric',
            ],[
                //Mensaje de error
                    //Valores numericos
                        'cedula.numeric' => 'Se requiere un valor numerico para la cédula',
                        'meses_mora.numeric' => 'Se requiere un valor numerico para los meses en mora',
                        'valor_pagar.numeric' => 'Se requiere un valor numerico para el campo de valor a pagar',

                    //Valores cadena
                        'nombre.string' => 'Se requiere un valor de texto para el nombre',    
                        'nombre.regex' => 'Se requiere un valor de texto para el nombre',    
                        'apellido.string' => 'Se requiere un valor de texto para el apellido',
                        'apellido.regex' => 'Se requiere un valor de texto para el apellido',

                    //Valores de fecha
                        'fecha_factura.date_format' => 'Se requiere una fecha con formato valido',    
                        'fecha_maxima.date_format' => 'Se requiere una fecha con formato valido',  

                    //Valores requeridos
                        'cedula.required' => 'La cédula es un campo obligatorio',    
                        'nombre.required' => 'El nombre es un campo obligatorio',
                        'apellido.required' => 'El apellido es un campo obligatorio',
                        'valor_pagar.required' => 'El valor a pagar es un campo obligatorio',
                        'fecha_factura.required' => 'La fecha de factura es un campo obligatorio',
                        'fecha_maxima.required' => 'La fecha maxima es un campo obligatorio',
                        'meses_mora.required' => 'Los meses en mora son un campo obligatorio',
            ]); 
        //Si los campos han sido validados, realizamos la consulta
            if ($campos_validados) {       
                //Realizamos la consulta Eloquent
                    Planillas::where('id', $valoresPagarItem->id)
                         ->update([
                                'cedula' => $cedula,
                                'nombre' => $nombre,
                                'apellido' => $apellido,
                                'valor_actual' => $valor_pagar,
                                'valor_restante' => $valor_pagar,
                                'fecha_factura' => $fecha_factura,
                                'fecha_maxima' => $fecha_maxima,
                                'meses_mora' => $meses_mora,
                            ]);
                //Redireccionamos y devolvemos variables
                    return redirect()->route('panel.index')->with([
                        'resultado_actualizacion' => 'El pago se ha ingresado correctamente',
                    ]);         
            
        //Si no se ha realizado la validación correctamente, regresamos al formulario anterior        
        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }
    }      

    /**
     * Mostramos el formulario para ingresar un pago
    */
    public function edit(Planillas $valoresPagarItem)
    {

    //Comprobamos si el medidor seleccionado tiene valores pendientes
        if ($valoresPagarItem->valor_actual > 0) {
            //Retornaremos a la vista con el formulario si existen valores pendientes
                return view('planillas.ingresar', [
                    'valoresPagarItem' => $valoresPagarItem
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
            $meses_mora = request('meses_mora');
            $valor_nuevo = request('valor_nuevo');
            $fecha = date("Y-m-d");
       //Validamos los valores recibidos desde el formulario anterior
            $campos_validados = request()->validate([
                'meses_mora' => 'required|numeric',
                'valor_nuevo' => 'required|numeric',
            ],[
                //Mensaje de error de meses
                    'meses_mora.numeric' => 'Se requiere un valor numerico para los meses en mora',
                    'valor_nuevo.numeric' => 'Se requiere un valor numerico para el campo de valor a pagar'
            ]);     
        //Realizamos la operacion matematica para restar valores
           
        //Restamos los valores existentes en la base de datos menos los recibidos en el formulario
            $valorFinalIngresar = $valoresPagarItem->valor_actual - $valor_nuevo;

        //Si los campos han sido validados, realizamos la consulta
        if ($campos_validados) {
                   
            //Realizamos la consulta Eloquent
                Planillas::where('id', $valoresPagarItem->id)
                     ->update([
                            'valor_actual' => $valorFinalIngresar,
                            'valor_pagado' => $valor_nuevo,
                            'valor_restante' => $valorFinalIngresar,
                            'meses_mora' => $meses_mora,
                            'fecha' => $fecha,
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