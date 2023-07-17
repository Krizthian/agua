<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'

class ValoresAPagarController extends Controller
{
    /**
     * Devolver resultados al Panel
     */
    public function index()
    {
        $valores_pagar = Pagos::paginate(10);
        return view('panel', compact('valores_pagar'));
    }

    /**
     * Devolver resultados al Home (Solicitud de Ciudadano)
     */
    public function indexCiudadano(Request $request){

    // Obtener los valores pasados por el formulario
        $medidor_cedula = $request->input('medidor_cedula');

    // Consulta Eloquent
        $query = Pagos::query();

    // Verificar si se ha proporcionado "numero_medidor" o "cedula" y agregar condiciones a la consulta
        if (isset($medidor_cedula)) {
            $query->where('numero_medidor', $medidor_cedula)
            ->orWhere('cedula', $medidor_cedula);
        

    // Ejecutar la consulta y obtener los resultados
        $resultados = $query->get();

    // Retornar los resultados
        return view('/home', compact('resultados', 'medidor_cedula'));
      //Si no se ha pasado ningun valor, redireccionamos al inicio                  
        }else{
        // Redireccionamos
            return redirect('/');
        }                
    }

    /**
     * Busqueda de valores individuales
     */
    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');

        //Consulta Eloquent
            $query = Pagos::query();

        //Verificamos si se recibio un valor        
            if(isset($valores)){
                $query->where('numero_medidor', $valores)
                      ->orWhere('cedula', $valores)
                      ->orWhere('apellido', $valores);
            }

         //Ejecutamos la consulta
            $valores_pagar = $query->paginate(10); //Solicitamos un maximo de valores para el paginado

         //Retornamos los valores
            return view('panel', compact('valores_pagar'));   
    }

    /**
     * Habilitar o Inhabilitar el servicio del agua
     */
    public function inhabilitar (Pagos $valoresPagarItem)
    {
        //Comprobamos el estado del servicio
            //Desactivamos el servicio si este se encuentra 'inactivo'
                if ($valoresPagarItem->estado_servicio == "activo") {
                    Pagos::where('id', '=', $valoresPagarItem->id)->update(['estado_servicio' => 'inactivo']);
                    return redirect()->route('panel.index')->with('resultado', 'Se ha suspendido el servicio al medidor '. ''. $valoresPagarItem->numero_medidor); //Devolvemos el mensaje de resultados a la vista 'panel'
            //Reactivamos el servicio si este se encuentra 'activo'
                }elseif ($valoresPagarItem->estado_servicio == "inactivo") {
                    Pagos::where('id', '=', $valoresPagarItem->id)->update(['estado_servicio' => 'activo']);
                    return redirect()->route('panel.index')->with('resultado', 'Se ha reactivado el servicio al medidor '. ''. $valoresPagarItem->numero_medidor); //Devolvemos el mensaje de resultados a la vista 'panel'
                }
    }

    /**
     * Mostramos el formulario para editar un medidor
     */
    public function edit(Pagos $valoresPagarItem)
    {

    //Comprobamos si el medidor seleccionado tiene valores pendientes
        if ($valoresPagarItem->valor_actual > 0) {
            //Retornaremos a la vista con el formulario si existen valores pendientes
                return view('pagos.ingresar', [
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
    public function update(Pagos $valoresPagarItem)
    {
        //Obtenemos las variables enviadas en el formulario
            $meses_mora = request('meses_mora');
            $valor_nuevo = request('valor_nuevo');
            $fecha = date("Y-m-d");

        //Realizamos la operacion matematica para restar valores
            /*
                Restamos los valores existentes en la base de datos menos los recibidos en el formulario
            */
            $valorFinalIngresar = $valoresPagarItem->valor_actual - $valor_nuevo;

        //Realizamos la consulta Eloquent
            Pagos::where('id', $valoresPagarItem->id)
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
    }

}
