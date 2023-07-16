<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo
//use Illuminate\Support\Facades\DB;

class ConsultaClienteController extends Controller
{

public function index(Request $request){

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
                    /**
                        $texto = trim($request_consulta= $request_consulta->get('medidor_cedula'));
                        $pagos_consulta=DB::table('pagos')
                        ->select('numero_medidor', 'valor_actual', 'meses_mora', 'valor_pagado', 'valor_restante', 'fecha', 'cedula')
                        ->where('numero_medidor','LIKE', '%'.$texto.'%')
                        ->orWhere('cedula','LIKE', '%'.$texto.'%')->get();
                        return view('consulta_cliente', compact('pagos_consulta', 'texto'));
                    */
                        
      //Si no se ha pasado ningun valor, redireccionamos al inicio                  
        }else{
        // Redireccionamos
            return redirect('/');
        }                
    }
}
