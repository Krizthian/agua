<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios; //Importamos el modelo que conecta con la tabla 'usuarios'

class LoginController extends Controller
{

    /*Procesar inicio de sesión*/
    public function login (Request $request)
    {
        //Recibimos las variables desde el formulario anterior
            $usuario = $request->input('usuario');
            $password = $request->input('password');


        //Definimos la consulta
            $query = Usuarios::query(); //Llamamos al modelo Usuarios

        //Ejecutamos la consulta
            if ($usuario) {
                //Buscamos y comparamos
                    $query->where('usuario', $usuario)
                                ->where('password', $password)
                                ->first();
                }       

                //Obtenemos los valores de la consulta 
                    $resultados = $query->get();
                    //Obtenemos valores especificos desde la BD
                        foreach ($resultados as $resultadosSesion) {
                            $usuarioBD = $resultadosSesion->usuario;
                            $passwordBD = $resultadosSesion->password;
                            $rol = $resultadosSesion->rol;
                            //Iniciamos la sesion y guardamos la cookie 
                                if ($usuario == $usuarioBD && $password == $passwordBD) {
                                       //Guardamos el rol y el usuario en variables de sesion
                                            $request->session()->put('sesion', ['usuario' => $usuario, 'rol' => $rol ]);
                                       //Redireccionamos 
                                            return redirect()->route('panel.index'); 
                                   }else {
                                       //Redireccionamos al login si hay algun error en la validacion
                                           return redirect()->route('login'); 
                                   }   
                } //Fin del foreach
    }
}
