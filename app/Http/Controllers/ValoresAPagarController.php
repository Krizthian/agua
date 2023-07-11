<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'

class ValoresAPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $valores_pagar = Pagos::paginate(10);
        return view('panel', compact('valores_pagar'));
    }

    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');

        //Consulta Eloquent
            $query = Pagos::query();

        //Verificamos si se recibio un valor        
            if(isset($valores)){
                $query->where('numero_medidor', $valores)
                      ->orWhere('cedula', $valores);
            }

         //Ejecutamos la consulta
            $valores_pagar = $query->paginate(10); //Solicitamos un maximo de valores para el paginado

         //Retornamos los valores
            return view('panel', compact('valores_pagar'));   
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
