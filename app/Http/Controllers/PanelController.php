<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Mantenimientos; //Importamos el modelo de la tabla 'mantenimientos'
use App\Models\Reclamos; //Importamos el modelo de la tabla 'reclamos'
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'
use App\Models\Usuarios; //Importamos el modelo de la tabla 'usuarios'


class PanelController extends Controller
{

    /*
    * Mostrar la pantalla principal del Panel de Gestión
    */

    public function index()
    {
     //Obtenemos los valores desde la base de datos   
          //Obtener valores de Planillas
            $planillas = Planillas::count();

          //Obtener valores de la tabla Clientes
            $clientes = Clientes::count();

          //Obtener valores de la tabla Medidores   
            $medidores = Medidores::count();

          //Obtener valores de la tabla Usuarios   
            $usuarios = Usuarios::count();

          //Obtener valores de la tabla Mantenimientos
            $mantenimientos = Mantenimientos::where('estado_mantenimiento', 'solicitado')
                ->orderBy('fecha_mantenimiento', 'desc')
                ->with('medidor')
                ->take(4)
                ->get();

          //Obtener valores de la tabla Reclamos
            $reclamos = Reclamos::where('estado_reclamo', 'ingresado')
                ->orderBy('fecha_reclamo', 'desc')
                ->take(4)
                ->get();

          //Obtener valores de la tabla Pagos (Del presente año)
            //Definimos la variable con el año actual
                $year = date('Y');
            //Obtenemos los pagos con el año actual      
                $contarMes = [];
                    for ($mes = 1; $mes <= 12; $mes++) {
                        $count = Pagos::whereYear('fecha_pago', $year)
                                     ->whereMonth('fecha_pago', $mes)
                                     ->count();
                        // Almacena la cantidad en el arreglo contarMes
                            $contarMes[$mes] = $count;
                    }
          //Retornamos los valores a la vista          
            return view('panel')
                ->with('planillas', $planillas)
                ->with('clientes', $clientes)
                ->with('medidores', $medidores)
                ->with('mantenimientos', $mantenimientos)
                ->with('reclamos', $reclamos)
                ->with('usuarios', $usuarios)
                ->with('contarMes', $contarMes);
    }

}
