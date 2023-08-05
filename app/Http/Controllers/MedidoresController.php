<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Consumos; //Importamos el modelo de la tabla 'consumos'
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'

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

        //Valores para la tabla de planillas
            //La factura se genera dos dias despues de la lectura
                $fecha_factura = date('Y-m-d', strtotime('+2 days', strtotime($fecha_lectura_actual)));
            //La fecha maxima de pago previo a que se suspenda el servicio es 5 dias despues de la fecha de factura    
                $fecha_maxima =  date('Y-m-d', strtotime('+5 days', strtotime($fecha_factura))); 
            //Realizamos el calculo de consumos en funcion de las tarifas e ingresarmos el valor en la variable valor_actual
                switch (true) {
                    case ($consumo_actual >= 0 && $consumo_actual <= 15):
                        $valor_actual = $consumo_actual * 0.308;
                        break;
                    case ($consumo_actual >= 16 && $consumo_actual <= 30):
                        $valor_actual = $consumo_actual * 0.457;
                        break;
                    case ($consumo_actual >= 31 && $consumo_actual <= 60):
                        $valor_actual = $consumo_actual * 0.646;
                        break;
                    case ($consumo_actual >= 61 && $consumo_actual <= 100):
                        $valor_actual = $consumo_actual * 0.810;
                        break;
                    case ($consumo_actual >= 101 && $consumo_actual <= 300):
                        $valor_actual = $consumo_actual * 0.903;
                        break;
                    case ($consumo_actual >= 301 && $consumo_actual <= 2500):
                        $valor_actual = $consumo_actual * 1.401;
                        break;
                    case ($consumo_actual >= 2501 && $consumo_actual <= 5000):
                        $valor_actual = $consumo_actual * 1.798;
                        break;
                    case ($consumo_actual > 5000):
                        $valor_actual = $consumo_actual * 2.956;
                        break;
                }  

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

                   Planillas::where('id_medidor', $id_medidor)
                   ->update([
                    'valor_actual' => $valor_actual,
                    'fecha_factura' => $fecha_factura,
                    'fecha_maxima' => $fecha_maxima

                   ]);
          //Redireccionamos y devolvemos variables
                return redirect()->route('medidores.index')->with([
                    'resultado_ingreso' => 'Los consumos se han ingresado correctamente',
                ]);         
            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }

    }

}