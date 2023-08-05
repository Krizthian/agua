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

    /**
     * Redireccionar al formulario de ingreso de consumos
    */

    public function ingresarConsumo(Medidores $consumoMedidorItem)
    {
        //Devolvemos todo lo obtenido al formulario de ingreso
            return view('medidores.consumos', [
                'consumoMedidorItem' => $consumoMedidorItem
            ]);

    }

    /**
     * Almacenar los nuevos consumos
    */

    public function almacenarConsumo(Medidores $consumoMedidorItem)
    {
        //Obtenemos los valores desde el formulario anterior
            $id_medidor = $consumoMedidorItem->id;
            $consumo_actual = request('consumo_actual');
            $fecha_lectura_actual = date("Y-m-d"); //Generamos una fecha actual
            $consumo_anterior = request('consumo_anterior');
            $fecha_lectura_anterior = request('fecha_lectura_anterior');
            $responsable = request('responsable'); 

        //Validamos los valores recibidos desde el formulario anterior    
            $campos_validados = request()->validate([
                'consumo_actual' => 'required|numeric',
                'responsable' => 'required',
            ],[
                //Mensajes de error valor numerico y requerido
                    //Consumo Actual
                        'consumo_actual.numeric' => 'Se requiere un valor numerico para el campo de consumo actual',
                        'consumo_actual.required' => 'El consumo actual es obligatorio',
                    //Responsable
                        'responsable.required' => 'El nombre del responsable es obligatorio'    

            ]);

         //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                   Consumos::where('id_medidor', $id_medidor)
                   ->update([
                    'consumo_actual' => $consumo_actual,
                    'fecha_lectura_actual' => $fecha_lectura_actual,
                    'consumo_anterior' => $consumo_anterior,
                    'fecha_lectura_anterior' => $fecha_lectura_anterior,
                    'responsable' => $responsable
                   ]);
          //Redireccionamos y devolvemos variables
                return redirect()->route('medidores.index')->with([
                    'resultado_ingreso' => 'El pago se ha ingresado correctamente',
                ]);         
            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }

    }

}