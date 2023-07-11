<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalirController extends Controller
{
    /*Procesar el logout*/
    public function salir (Request $request)
    {
        session()->flush(); //Esto limpiará la sesión existente
        return redirect('/login'); //Redireccionamos a la pagina de inicio
    }
}
