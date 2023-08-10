<?php

namespace App\Http\Controllers;

use App\Mail\RecuperacionContraseña; //Importamos la propiedad para el envio de correos
use App\Models\Usuarios;  // Importamos el modelo que conecta con la tabla 'usuarios'
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
                    //Obtenemos los nombres
                        $nombres = $usuarioEncontrado->nombre . ' ' . $usuarioEncontrado->apellido;
                    // Guardamos el rol y el usuario en variables de sesión
                        $request->session()->put('sesion', ['usuario' => $usuarioEncontrado->usuario, 'rol' => $usuarioEncontrado->rol, 'nombres' => $nombres]);
                    // Redireccionamos al panel de control
                        if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){
                            return redirect()->route('panel.index');
                        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                            return redirect()->route('medidores.index');
                        }

                }

            }
            // Redireccionamos al login si hay algún error en la validación
                 return redirect()->route('login')->with('resultado_login', 'El usuario o la contraseña son incorrectos');
    }

    /*Mostrar formulario de recuperación de contraseña*/
        public function recuperarFormulario (Request $request)
    {
        //Retornamos el formulario para recuperar la contraseña
            return view('login.recuperar');
    }

    /*Procesamos la recuperación de credenciáles*/
        public function recuperarProceso (Request $request)
    {
        //Recibimos las variables desde el formulario anterior
            $email = $request->input('email');
        // Realizamos la consulta para encontrar el usuario asociado al correcto electronico
            $emailEncontrado = Usuarios::where('email', $email)->first();

        //Iniciamos el proceso de recuperacion de credenciales
          if ($emailEncontrado) {
            //Comprobamos si el correo coincide con el de la base de datos
                if ($emailEncontrado->email == $email) {
                //Generamos un token 
                    $token = Str::random(40);

                //Almacenamos el token en una variuable de sesion    
                    $request->session()->put('token', ['token' => $token]);

                //Almacenamos la id en una variable
                    $id_usuarioRecuperar = $emailEncontrado->id;

                //Enviamos el correo electronico
                    Mail::to($email)->send(new RecuperacionContraseña($token, $id_usuarioRecuperar));
            }
          } 

        // Redireccionamos al login nuevamente
            return redirect()->route('login')->with('resultado_recuperacion', 'Enlace enviado'); 
    }

   /*Procesamos la recuperación de credenciáles*/
        public function validarToken (Request $request)  
        {
            $tokenRecibido = $request->input('token');
            $sessionToken = session('token'); //Buscamos el token de nuestra variable de sesion
            $id_usuarioRecuperar = $request->input('id');

            // Realizamos la consulta para encontrar el usuario
                $idUsuarioEncontrado = Usuarios::where('id', $id_usuarioRecuperar)->first();

           // Verificamos que el token exista en la sesión y no esté expirado
            if ($sessionToken && isset($sessionToken['token']) && $sessionToken['token'] == $tokenRecibido) {
                return view('login.actualizar', [
                    'tokenRecibido' => $tokenRecibido,
                    'sessionToken' => $sessionToken,
                    'id_usuarioRecuperar' => $idUsuarioEncontrado->id
                ]);

            }else{
               // Redireccionamos al login nuevamente
                    return redirect()->route('login')->with('enlace_expirado', 'Enlace expirado');   
            }
        } 

    /*Actualizamos las credenciales*/
        public function recuperacionUpdate (Request $request)  
        {
            //Validamos los campos recibidos
                $campos_validados = request()->validate([
                    'password' => 'required'
                ],[
                //Mensajes de error de cédula
                    'password.required' => 'El campo contraseña es obligatorio',
             ]);

            //Si los campos han sido vlaidados, actualizamos la contraseña
            if ($campos_validados) {
                //Realizamos la consulta Eloquent
                    Usuarios::where('id', $request->input('id_usuario'))
                            ->update([
                                'password' => request('password'),
                            ]);
              //Limpiamos el token 
                   session()->flush();            
              //Redireccionamos 
                return redirect()->route('login')->with('resultado_cambio', 'La contraseña ha sido actualizada correctamente');            
             }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
             }

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
