<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'

class MedidoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medidores = Medidores::paginate(10);
        return view('medidores', compact('medidores'));
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
                $query->where('numero_medidor', $valores)
                      ->orWhere('cedula', $valores)
                      ->orWhere('apellido', $valores);
            }

        //Ejecutamos la consulta
            $medidores = $query->paginate(10); //Solicitamos un maximo de valores para el paginado  

        //Retornamos los valores
            return view('medidores', compact('medidores'));              
    }
    /**
     * Mostramos el formulario para crear un nuevo medidor
     */
    public function create()
    {
        return view('medidores.crear'); //Retornaremos a la vista con el formulario
    }

    /**
     * Ingresamos el medidor en la base de datos
     */
    public function store(Request $request)
    {
        //Validamos los valores recibidos
        $campos_validados = request()->validate([
            'numero_medidor' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);
         //Insertamos los valores en la tabla
            Medidores::create($campos_validados);
        //Redireccionamos
            return redirect()->route('medidores.index')->with('resultado_creacion', 'Se ha creado el medidor correctamente');    
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medidores $medidoresItem)
    {
       //Realizamos la consulta Eloquent 
            Medidores::destroy($medidoresItem->id);

       //Redireccionamos 
            return redirect()->route('medidores.index')->with('resultado', 'El medidor ha sido eliminado');  
    }
}
