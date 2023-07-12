<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'

class ReportesController extends Controller
{
    /**
     * Generación de reportes
    */
    public function generar(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $tipo = $request->input('tipo');
            $mes = $request->input('mes');
            $year = $request->input('year');
            //Combinamos el 'año' y 'mes'
             $month_year = $year.'-'.$mes;

        //Generación de reporte de pagos              
        if ($tipo == 'pagos') {
                $query = Pagos::where('fecha', 'LIKE', $month_year.'%')->get();
        //Devolvemos los valores        
               return view('reportes', compact('query'));

        /*Obtención de reportes Inactivos y Activos*/
                //Generación de reporte de medidores que se encuentren inactivos  
                }elseif ($tipo == 'medidores_inactivos') {
                       $query = Pagos::where('estado_servicio', 'inactivo')->get();  
                        //Devolvemos los valores        
                       return view('reportes', compact('query'));
                //Generación de reporte de medidores que se encuentren activos        
                 }elseif ($tipo == 'medidores_activos') {
                       $query = Pagos::where('estado_servicio', 'activo')->get();  
                        //Devolvemos los valores        
                       return view('reportes', compact('query'));
                 }  
    }
}
