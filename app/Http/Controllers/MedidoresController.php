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
            'numero_medidor' => 'required|unique:medidores',
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|numeric',
            'direccion' => 'required',
            'telefono' => 'required|numeric',
        ],[
            'numero_medidor.unique' => 'Este medidor ya se encuentra registrado',
            'cedula.numeric' => 'El campo cédula debe contener números',
            'telefono.numeric' => 'El campo télefono debe contener números',
        ]);
        if ($campos_validados) {
        //Insertamos los valores en la tabla
            Medidores::create($campos_validados);
        //Redireccionamos
            return redirect()->route('medidores.index')->with('resultado_creacion', 'Se ha creado el medidor correctamente'); 
        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }
   
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Mostramos el formulario para editar un medidor
     */
    public function edit(Medidores $medidoresItem)
    {
        //Retornaremos a la vista con el formulario
           return view('medidores.editar', [
            'medidoresItem' => $medidoresItem
           ]); 
    }

    /**
     * Actualizamos el valor en la base de datos
     */
    public function update(Medidores $medidoresItem)
    {
        //Realizamos la consulta Eloquent
            Medidores::where('id', $medidoresItem->id)
                    ->update([
                        'nombre' => request('nombre'),
                        'apellido' => request('apellido'),
                        'cedula' => request('cedula'),
                        'direccion' => request('direccion'),
                        'telefono' => request('telefono'),
                    ]);
        //Redireccionamos 
            return redirect()->route('medidores.index')->with('resultado_edicion', 'El medidor se ha actualizado correctamente');               
    }

    /**
     * Eliminar el valor en la base de datos
     */
    public function destroy(Medidores $medidoresItem)
    {
       //Realizamos la consulta Eloquent 
            Medidores::destroy($medidoresItem->id);

       //Redireccionamos 
            return redirect()->route('medidores.index')->with('resultado', 'El medidor ha sido eliminado');  
    }
}
