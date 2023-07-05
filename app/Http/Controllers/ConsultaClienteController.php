<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo
use Illuminate\Support\Facades\DB;

class ConsultaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request_consulta)
    {
        $texto = trim($request_consulta= $request_consulta->get('medidor_cedula'));
        $pagos_consulta=DB::table('pagos')
        ->select('numero_medidor', 'valor_actual', 'meses_mora', 'valor_pagado', 'valor_restante', 'fecha', 'cedula')
        ->where('numero_medidor','LIKE', '%'.$texto.'%')
        ->orWhere('cedula','LIKE', '%'.$texto.'%')->get();
        return view('consulta_cliente', compact('pagos_consulta', 'texto'));
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
