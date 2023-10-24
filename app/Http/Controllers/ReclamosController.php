<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamos; //Importamos el modelo de la tabla 'reclamos'
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'


class ReclamosController extends Controller
{
    /**
     * Devolvemos un listado de los reclamos existentes
    */
    public function index()
    {   
        $reclamos = Reclamos::paginate(10);
        return view('reclamos', compact('reclamos'));
    }

     /**
     * Devolvemos información de un reclamo en especifico
    */
    public function show(Reclamos $reclamosItem)
    {   
        $reclamosCliente = Reclamos::where('numero_medidor', $reclamosItem->numero_medidor)->get();
        //Retornaremos a la vista con los valores
           return view('reclamos.reclamo', [
            'reclamosItem' => $reclamosItem,
            'reclamosCliente' => $reclamosCliente
           ]); 
    }   
     /**
     * Procesamos la busqueda
    */
     public function busqueda(Request $request)
     {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');
        //Realizamos la consulta Eloquent
            $query = Reclamos::query();

        //Verificamos si tenemos un valor recibido        
            if (isset($valores)) {
                $query->where('numero_medidor', $valores)
                    ->orWhere('numero_planilla', $valores)
                    ->orWhere('apellido', 'LIKE', '%' . $valores . '%') //Ajustamos la busqueda para que no requiera valores exactos
                    ->orWhere('id', $valores);
            }

        //Ejecutamos la consulta
            $reclamos = $query->paginate(10);
            
        //Retornamos los valores
            return view('reclamos', compact('reclamos'));        
     }


    /**
     * Mostramos el formulario para el ingreso de reclamo
     */
    public function create(Planillas $pagosConsultaItem)
    {
        //Redireccionamos al formulario de creacion
            return view('reclamos.crear', compact('pagosConsultaItem')); 
    }

    /**
     * Ingresamos los valores recibidos del formulario
     */
    public function store(Request $request)
    {
        //Creamos variables para ingreso
            $fecha_reclamo = date("Y-m-d");
        //Validamos los campos recibidos
             $campos_validados = request()->validate([
                'nombre' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                'apellido' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                'numero_medidor' => 'required|numeric',
                'numero_planilla' => 'required|numeric',
                'email' => 'required',
                'telefono' => 'required|numeric',
                'motivo' => 'required',
            ],[
                'nombre.regex' => 'El campo nombre debe contener texto',
                'apellido.regex' => 'El campo apellido debe contener texto',                 
                'nombre.required' => 'El nombre es un campo obligatorio',
                'apellido.required' => 'El apellido es un campo obligatorio',
                'numero_medidor.required' => 'El numero de medidor es un campo obligatorio',
                'numero_medidor.numeric' => 'El numero de medidor debe ser un valor numérico',
                'numero_planilla.required' => 'El numero de planilla es un campo obligatorio',
                'numero_planilla.numeric' => 'El numero de planilla debe ser un valor numérico',
                'email.required' => 'El correo electrónico es un campo obligatorio',
                'telefono.required' => 'El teléfono es un campo obligatorio',
                'telefono.numeric' => 'El campo de teléfono debe contener numeros',
                'motivo.required' => 'El motivo del reclamo es un campo obligatorio',
            ]);           
        //Comprobamos si los campos estan validados
             if ($campos_validados) {
                //Ingresamos los datos en la tabla de Planillas
                    Reclamos::create([
                        'nombre' => $campos_validados['nombre'],
                        'apellido' => $campos_validados['apellido'],
                        'numero_medidor' => $campos_validados['numero_medidor'],
                        'numero_planilla' => $campos_validados['numero_planilla'],
                        'email' => $campos_validados['email'],
                        'motivo' => $campos_validados['motivo'],
                        'estado_reclamo' => "ingresado",
                        'fecha_reclamo' => $fecha_reclamo,
                        'telefono' => $campos_validados['telefono'],

                    ]);
                //Redireccionamos y devolvemos variables
                return redirect()->route('home')->with([
                    'resultado_creacion' => 'Se ha creado la nueva planilla correctamente',
                ]);             
             }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
             }
    }

    /**
     * Devolver formulario para actualizar el estado del reclamo
    */
    public function actualizarEstado(Reclamos $reclamosItem)
    {

        //Obtenemos la informacion del reclamo
            $queryReclamos = Reclamos::where('id', '=', $reclamosItem->id)->get();

        //Devolvemos todo lo obtenido al formulario de actualización    
            return view('reclamos.actualizar', [
                'reclamosItem' => $reclamosItem,
                'queryReclamos' => $queryReclamos
            ]);
    }

    /**
     * Procesar actualización de estado de reclamo
    */
    public function update(Request $request, Reclamos $reclamosItem)
    {
        //Obtenemos los valores
            $estado_reclamo = $request->input('estado_reclamo');
            $observacion = $request->input('observacion');

        //Actualizamos el estado
                Reclamos::where('id', '=', $reclamosItem->id)->update(['estado_reclamo' => $estado_reclamo, 'observacion' => $observacion]);
                return redirect()->route('reclamos.index')->with('resultado', 'Se ha actualizado el estado del reclamo '. '#'. $reclamosItem->id); //Devolvemos el mensaje de resultados a la vista 'reclamos'
    }

}