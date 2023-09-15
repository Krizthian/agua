<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //Comprobamos el rol   
      if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){

        $pagos = Pagos::with(['cliente', 'planilla'])->paginate(10);
        return view('pagos', compact('pagos'));

    //Redireccionamos si el rol no es el permitido        
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
            return redirect()->route('medidores.index');    
        } 
    }

    public function busqueda(Request $request)
    {
    //Comprobamos el rol   
      if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){
        //Obtenemos los valores del formulario de busqueda
            $valores = $request->input('valores');
        //Consulta Eloquent    
            $query = Pagos::with(['cliente', 'planilla']);

        //Verificamos si se recibio un valor y realizamos la busqeuda
            if (isset($valores)) {
                $query->where(function ($q) use ($valores) {
                    $q->whereHas('cliente', function ($subQuery) use ($valores) {
                        $subQuery->where('apellido', 'like', '%' . $valores . '%') //Ajustamos la exactitud en la busqueda
                            ->orWhere('cedula', $valores)
                            ->orWhere('numero_recibo', $valores);
                    })
                    ->orWhere(function ($subQuery) use ($valores) {
                        $subQuery->where('id_planilla', 'like', '%' . $valores . '%');
                    });
                });
            }
        //Ejecutamos la consulta
            $pagos = $query->paginate(20);
        //Retornamos los valores
            return view('pagos', compact('pagos'));    
     //Redireccionamos si el rol no es el permitido        
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
            return redirect()->route('medidores.index');    
            } 
        } 

/**
* Mostrar recibo
*/

public function mostrarRecibo (Pagos $pagosItem){

     //Comprobamos el rol   
      if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){

        //Obtenemos los valores
           $pagosItemGet = Pagos::with(['cliente', 'planilla'])
           ->where('id', $pagosItem->id) 
           ->first();

       //Retornaremos a la vista con el formulario
           return view('pagos.recibo', [
            'numero_recibo' => $pagosItemGet->numero_recibo,
            'nombre_cliente' => $pagosItemGet->cliente->nombre,
            'apellido_cliente' => $pagosItemGet->cliente->apellido,
            'id_planilla' => $pagosItemGet->planilla->id,
            'medidor_pagado' => $pagosItem->planilla->medidor->numero_medidor,
            'valor_a_pagar' => $pagosItemGet->valor_a_pagar,
            'valor_pagado' => $pagosItemGet->valor_pagado,
            'forma_pago' => $pagosItemGet->forma_pago,
            'cajero' => $pagosItemGet->cajero,
            'fecha' => $pagosItemGet->fecha_pago,
           ]); 

     //Redireccionamos si el rol no es el permitido   
         }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
        }     

}

}
