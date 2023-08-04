<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::with('medidor')->paginate(10); 
        return view('clientes', ['clientes' => $clientes]);
    }
    
    /**
     * Busqueda de Clientes
     */

    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');
        
        //Consulta Eloquent
                $query = Clientes::query();

        //Verificamos si se recibio un valor        
            if(isset($valores)){
                $query->where('cedula', $valores)
                      ->orWhere('nombre', $valores)
                      ->orWhere('apellido', $valores)
                      ->orWhere('cedula', $valores);
            }

        //Ejecutamos la consulta
            $clientes = $query->paginate(10); //Solicitamos un maximo de valores para el paginado  

        //Retornamos los valores
            return view('clientes', compact('clientes'));              
    }
    /**
     * Mostramos el formulario para crear un nuevo cliente
     */
    public function create()
    {
        return view('clientes.crear'); //Retornaremos a la vista con el formulario
    }

    /**
     * Ingresamos el cliente en la base de datos
     */
    public function store(Request $request)
    {
        //Validamos los valores recibidos
        $campos_validados = request()->validate([
            'numero_medidor' => 'required|unique:clientes',
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|numeric',
            'direccion' => 'required',
            'telefono' => 'required|numeric',
        ],[
            'numero_medidor.unique' => 'Este medidor ya se encuentra registrado',
            'cedula.numeric' => 'El campo cédula debe contener números',
            'telefono.numeric' => 'El campo teléfono debe contener números',
        ]);
        if ($campos_validados) {
        //Insertamos los valores en la tabla
            Clientes::create($campos_validados);
        //Redireccionamos
            return redirect()->route('clientes.index')->with('resultado_creacion', 'Se ha creado el cliente correctamente'); 
        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }
   
        }

    /**
     * Mostramos el formulario para editar un cliente
     */
    public function edit(Clientes $clientesItem)
    {
        //Retornaremos a la vista con el formulario
           return view('clientes.editar', [
            'clientesItem' => $clientesItem
           ]); 
    }

    /**
     * Actualizamos el valor en la base de datos
     */
    public function update(Clientes $clientesItem)
    {
    //Validamos los valores recibidos
        $campos_validados = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required|numeric',
            'direccion' => 'required',
            'telefono' => 'required|numeric',
        ],[
            'cedula.numeric' => 'El campo cédula debe contener números',
            'telefono.numeric' => 'El campo télefono debe contener números',
        ]);
        if ($campos_validados) {
            //Realizamos la consulta Eloquent
                Clientes::where('id', $clientesItem->id)
                        ->update([
                            'nombre' => request('nombre'),
                            'apellido' => request('apellido'),
                            'cedula' => request('cedula'),
                            'direccion' => request('direccion'),
                            'telefono' => request('telefono'),
                        ]);
            //Redireccionamos 
                return redirect()->route('clientes.index')->with('resultado_edicion', 'El cliente se ha actualizado correctamente');
         }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }                      
    }

    /**
     * Eliminar el valor en la base de datos
     */
    public function destroy(Clientes $clientesItem)
    {
       //Realizamos la consulta Eloquent 
            Clientes::destroy($clientesItem->id);

       //Redireccionamos 
            return redirect()->route('clientes.index')->with('resultado', 'El cliente ha sido eliminado');  
    }
}
