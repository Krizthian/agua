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
    public function destroy(string $id)
    {
        //
    }
}
