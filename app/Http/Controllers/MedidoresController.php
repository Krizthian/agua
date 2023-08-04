<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Consumos; //Importamos el modelo de la tabla 'consumos'

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

}