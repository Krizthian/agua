<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagos; //Importamos el modelo de la tabla 'pagos'
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pagos::with(['cliente', 'planilla'])->paginate(10);
        return view('pagos', compact('pagos'));
    }

    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario de busqueda
            $valores = $request->input('valores');

        //Consulta Eloquent    
            $query = Pagos::with(['cliente', 'planilla']);

        //Verificamos si se recibio un valor y realizamos la busqeuda
            if (isset($valores)) {
                $query->where(function ($q) use ($valores) {
                    $q->whereHas('cliente', function ($subQuery) use ($valores) {
                        $subQuery->where('apellido', 'like', '%' . $valores . '%')
                            ->orWhere('cedula', $valores);
                    })
                    ->orWhere(function ($subQuery) use ($valores) {
                        $subQuery->where('id_planilla', 'like', '%' . $valores . '%');
                    });
                });
            }
        //Ejecutamos la consulta
            $pagos = $query->paginate(10);
        //Retornamos los valores
            return view('pagos', compact('pagos'));    
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
