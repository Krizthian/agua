<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'
use Carbon\Carbon; //Importamos la libreria 'Carbon' para manipular fechas

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

            $month_year = $year.'-'.$mes;
        //Generación de reporte de pagos              
        if ($tipo = 'pagos') {
                $query = Pagos::whereMonth('fecha', Carbon::parse($year.'-'.$mes)->month)->get();
        //Devolvemos los valores        
               return view('reportes', compact('query'));

        //Generación de reporte de medidores   
        // }elseif ($tipo = 'medidores_inactivos') {
                // code...
        
         } 
    }
}
