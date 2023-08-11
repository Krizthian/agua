<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarifas; //Importamos el modelo de la tabla 'Tarifas'

class AjustesController extends Controller
{
    /**
     * Devolver resultados a la pagina de ajustes
     */
    public function index()
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){
                $tarifas = Tarifas::all();
                return view('ajustes', compact('tarifas'));

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'personal'){
                return redirect()->route('medidores.index');
            }    
    }

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
 
}
