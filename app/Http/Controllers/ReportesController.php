<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Mantenimientos; //Importamos el modelo de la tabla 'mantenimientos'
use App\Models\Reclamos; //Importamos el modelo de la tabla 'reclamos'

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
                $query = Pagos::with('cliente', 'planilla')
                ->where('fecha_pago', 'LIKE', $month_year.'%')
                ->get();
        //Devolvemos los valores        
               return view('reportes', compact('query'));

        /*Obtención de reportes Inactivos y Activos*/
                //Generación de reporte de medidores que se encuentren inactivos  
                }elseif ($tipo == 'medidores_inactivos') {
                       $queryMedidoresInactivos = Planillas::where('estado_servicio', 'inactivo')->get();  
                        //Devolvemos los valores        
                            return view('reportes', compact('queryMedidoresInactivos'));
                //Generación de reporte de medidores que se encuentren activos        
                 }elseif ($tipo == 'medidores_activos') {
                       $queryMedidoresActivos = Planillas::where('estado_servicio', 'activo')->get();  
                        //Devolvemos los valores        
                            return view('reportes', compact('queryMedidoresActivos'));
        /*Obteneción de deudores*/
                //Generación de reporte de deudores
                }elseif ($tipo == 'deudores') {
                        $queryDeudores = Planillas::with('cliente', 'medidor')
                                        ->where('meses_mora', '>=', 1)
                                        ->get();
                //Devolvemos los valores        
                         return view('reportes', compact('queryDeudores'));

         /*Obtención de mantenimientos*/               
                 }elseif ($tipo == 'mantenimientos'){
                    $queryMantenimientos = Mantenimientos::with('medidor')
                    ->where('fecha_mantenimiento', 'LIKE', $month_year.'%')
                    ->get();
                    //Devolvemos los valores
                        return view('reportes', compact('queryMantenimientos'));
         /*Obtención de reclamos*/               
                 }elseif ($tipo == 'reclamos'){
                    $queryReclamos = Reclamos::where('fecha_reclamo', 'LIKE', $month_year.'%')->get();
                    //Devolvemos los valores
                        return view('reportes', compact('queryReclamos'));                   
    }
  }
}