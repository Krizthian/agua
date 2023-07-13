<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios; //Importamos el modelo que conecta con la tabla 'usuarios'

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuarios::paginate(5); //Obtenemos los valores y los paginamos
        return view ('usuarios', compact('usuarios')); //Devolvemos los resultados a la vista 'usuarios'
    }

    /**
     * Busqueda de Usuarios
     */

    public function busqueda (Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');

        //Consulta Eloquent
            $query = Usuarios::query();

        //Verificamos si se recibio un valor
            if (isset($valores)) {
                $query->where('usuario',$valores)
                    ->orWhere('apellido',$valores);
            }  

        //Ejecutamos la consulta          
            $usuarios = $query->paginate(10);

        //Retornamos a la vista
            return view('usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Usuarios $usuariosItem)
    {
        //Comprobamos si el usuario es un administrador
            if ($usuariosItem->rol == 'administrador') {
                return redirect()->route('usuarios.index')->with('error', 'No se puede eliminar a un administrador'); //Devolvemos el mensaje de error a la vista 'usuarios'
            }else{

        //Si el usuario no es un administrador, procedemos con la eliminación        
            //Realizamos la consulta Eloquent
                Usuarios::destroy($usuariosItem->id);
            //Redireccionamos    
                return redirect()->route('usuarios.index');
            }
    }
}
