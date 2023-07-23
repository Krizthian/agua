<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios; // Importamos el modelo que conecta con la tabla 'usuarios'

class LoginController extends Controller
{

    /* Procesar inicio de sesión */
    public function login(Request $request)
    {
        // Recibimos las variables desde el formulario anterior
            $usuario = $request->input('usuario');
            $password = $request->input('password');

        // Realizamos la consulta para encontrar el usuario
            $usuarioEncontrado = Usuarios::where('usuario', $usuario)->first();

        if ($usuarioEncontrado) {
            // Verificamos la contraseña
                if ($usuarioEncontrado->password === $password) {
                    // Guardamos el rol y el usuario en variables de sesión
                        $request->session()->put('sesion', ['usuario' => $usuarioEncontrado->usuario, 'rol' => $usuarioEncontrado->rol]);
                    // Redireccionamos al panel de control
                        return redirect()->route('panel.index');
                }

            }
            // Redireccionamos al login si hay algún error en la validación
                 return redirect()->route('login')->with('resultado_login', 'El usuario o la contraseña son incorrectos');
    }

    /*Procesar el logout*/
    public function salir (Request $request)
    {
        //Limpamos las sesiones existentes
         session()->flush(); 
        //Redireccionamos a la pagina de inicio de sesión
         return redirect()->route('login')->with('resultado_logout', 'Se ha cerrado la sesión'); 
    }
}
