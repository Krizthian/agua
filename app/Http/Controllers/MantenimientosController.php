<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Mantenimientos; //Importamos el modelo de la tabla 'mantenimientos'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'


class MantenimientosController extends Controller
{
     /**
     * Mostrar los mantenimientos existentes
     */
    public function index()
    {
        $mantenimientos = Mantenimientos::with('medidor')->paginate(10); 
        return view('mantenimientos', ['mantenimientos' => $mantenimientos]);
    }

    /**
    * Busqueda de mantenimientos
    */
    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');       
        //Consulta Eloquent
            $query = Mantenimientos::with('medidor');
        //Verificamos si se recibio un valor        
            if(isset($valores)){
                $query->where(function ($q) use ($valores) {
                    $q->whereHas('medidor', function ($subQuery) use ($valores) {
                        $subQuery->where('numero_medidor', $valores);
                    });
                });
            }
        //Ejecutamos la consulta
            $mantenimientos = $query->paginate(10); //Solicitamos un maximo de valores para el paginado  

        //Retornamos los valores
            return view('mantenimientos', compact('mantenimientos'));  
    }

    /**
    * Actualizar estado de solicitud
    */
    public function actualizarEstado (Mantenimientos $mantenimientosItem)
    {
        //Comprobamos el estado del servicio
            //Cambiamos el estado del mantenimiento a "completado"
                if ($mantenimientosItem->estado_mantenimiento == "en proceso") {
                    Mantenimientos::where('id', '=', $mantenimientosItem->id)->update(['estado_mantenimiento' => 'completado']);
                    return redirect()->back()->with('resultado', 'Se ha actualizado el estado del medidor '. ''. $mantenimientosItem->medidor->numero_medidor); //Devolvemos el mensaje de resultados a la vista 'mantenimientos'
            //Cambiamos el estado del mantenimiento a "en proceso"
                }elseif ($mantenimientosItem->estado_mantenimiento == "solicitado") {
                    Mantenimientos::where('id', '=', $mantenimientosItem->id)->update(['estado_mantenimiento' => 'en proceso']);
                    return redirect()->back()->with('resultado', 'Se ha actualizado el estado del medidor '. ''. $mantenimientosItem->medidor->numero_medidor); //Devolvemos el mensaje de resultados a la vista 'mantenimientos'
            //Cambiamos el estado del mantenimiento a "solicitado"        
                }elseif ($mantenimientosItem->estado_mantenimiento == "completado" || $mantenimientosItem->estado_mantenimiento == "en proceso"){
                    Mantenimientos::where('id', '=', $mantenimientosItem->id)->update(['estado_mantenimiento' => 'solicitado']);
                    return redirect()->back()->with('resultado', 'Se ha actualizado el estado del medidor '. ''. $mantenimientosItem->medidor->numero_medidor); //Devolvemos el mensaje de resultados a la vista 'mantenimientos' 
                }
    }

    /**
     * Mostrar el formulario para la solicitud de mantenimiento
    */
    public function create(Medidores $consumoMedidorItem)
    {
        //Redireccionamos al formulario de creacion
            return view('mantenimientos.crear', compact('consumoMedidorItem')); 
    }

    /**
     * Almacenar la solicitud de mantenimiento
    */
    public function store(Request $request, Medidores $consumoMedidorItem)
    {
            //Asignamos variables
                $id_medidor = request('id_medidor');
                $numero_medidor = request('numero_medidor'); 
                $fecha_solicitud = date("Y-m-d"); //Obtenemos la fecha actual
            //Validamos los valores recibidos
            $campos_validados = request()->validate([
                'responsable_asignado' => 'required',
                'estado_mantenimiento' => 'required',
                'fecha_mantenimiento' => 'required',
            ],[
                'responsable_asignado.required' => 'El campo de responsable asignado es obligatorio',
                'estado_mantenimiento.required' => 'El campo de estado de mantenimiento es obligatorio',
                'fecha_mantenimiento.required' => 'El campo de fecha para mantenimiento es obligatorio',
            ]);
            //Comprobamos si se validaron los campos
                if ($campos_validados) {
                    Mantenimientos::create([
                        'id_medidor' => $id_medidor,
                        'fecha_solicitud' => $fecha_solicitud,
                        'fecha_mantenimiento' => $campos_validados['fecha_mantenimiento'],
                        'responsable_asignado' => $campos_validados['responsable_asignado'],
                        'estado_mantenimiento' => $campos_validados['estado_mantenimiento'],
                   ]);
             //Redireccionamos
                return redirect()->route('mantenimientos.index')->with('resultado_creacion', 'Se ha solicitado el mantenimiento correctamente');

                }else{
                    return redirect()->back()->withErrors($campos_validados)->withInput();
                }
    }

    /**
     * Mostrar formulario para editar la solicitud de mantenimiento
     */
    public function edit(Mantenimientos $mantenimientosItem)
    {
        //Obtenemos la informacion de los medidores
            $queryMedidores = Medidores::with('cliente')->get();
        //Devolvemos todo lo obtenido al formulario de actualización
            return view('mantenimientos.editar', [
                'mantenimientosItem' => $mantenimientosItem,
                'queryMedidores' => $queryMedidores
            ]);    
    }

    /**
     * Actualizamos la base de datos con la solicitud
     */
    public function update(Request $request, Mantenimientos $mantenimientosItem)
    {
        //Obtenemos los valores
            $id_mantenimiento = $mantenimientosItem->id;
            $id_medidor = $request->input('id_medidor');
            $fecha_mantenimiento = $request->input('fecha_mantenimiento');

        //Validamos los valores recibidos
            $campos_validados = request()->validate([
                'responsable_asignado' => 'required',
                'estado_mantenimiento' => 'required',
            ],[
                'responsable_asignado.required' => 'El campo de responsable asignado es obligatorio',
                'estado_mantenimiento.required' => 'El campo de estado de mantenimiento es obligatorio',
            ]);
        //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                //Actualizamos los valores en la tabla de mantenimientos
                    Mantenimientos::where('id', $id_mantenimiento)
                       ->update([
                        'id_medidor' => $id_medidor,
                        'fecha_mantenimiento' => $fecha_mantenimiento,
                        'responsable_asignado' => $campos_validados['responsable_asignado'],
                        'estado_mantenimiento' => $campos_validados['estado_mantenimiento']
                    ]);
        //Redireccionamos
            return redirect()->route('mantenimientos.index')->with('resultado', 'Se ha actualizado la información de solicitud de mantenimiento correctamente'); 

            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
        }                     
    }
}
