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
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){  

                $usuarios = Usuarios::paginate(5); //Obtenemos los valores y los paginamos
                return view ('usuarios', compact('usuarios')); //Devolvemos los resultados a la vista 'usuarios'

        //Redireccionamos en caso de que el rol no sea un "administrador"   
            }else{
                return redirect()->route('medidores.index');
            }     
    }

    /**
     * Busqueda de Usuarios
     */

    public function busqueda (Request $request)
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){ 

                //Obtenemos los valores del formulario anterior
                    $valores = $request->input('valores');

                //Consulta Eloquent
                    $query = Usuarios::query();

                //Verificamos si se recibio un valor
                    if (isset($valores)) {
                        $query->where('usuario',$valores)
                            ->orWhere('nombre', 'LIKE', '%' . $valores . '%') //Ajustamos la búsqueda para que no requiera valores exactos
                            ->orWhere('apellido', 'LIKE', '%' . $valores . '%'); //Ajustamos la búsqueda para que no requiera valores exactos
                    }  

                //Ejecutamos la consulta          
                    $usuarios = $query->paginate(10);

                //Retornamos a la vista
                    return view('usuarios', compact('usuarios'));

          //Redireccionamos en caso de que el rol no sea un "administrador"   
            }else{
                return redirect()->route('medidores.index');
            }  


    }

    /**
     * Mostramos el formulario para crear un nuevo usuario
     */
    public function create()
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){ 

                return view('usuarios.crear'); //Retornaremos a la vista con el formulario

        //Redireccionamos en caso de que el rol no sea un "administrador"   
            }else{
                return redirect()->route('medidores.index');
            } 
    }

    /**
     * Ingresamos el usuario en la base de datos
     */
    public function store(Request $request)
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){ 

                //Validamos los valores recibidos
                    $fecha_actual = date("Y-m-d H:i:s"); //Generamos una fecha actual
                    $campos_validados = request()->validate([
                        'usuario' => 'required|unique:usuarios',
                        'password' => 'required',
                        'nombre' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                        'apellido' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                        'cedula' => 'required|unique:usuarios|numeric|digits_between:10,13',
                        'rol' => 'required',
                        'email' => 'required|email|unique:usuarios',
                        'telefono' => 'required|numeric|digits_between:7,10',
                    ],[
                        //Mensajes de error de nombres
                            'nombre.regex' => 'El campo nombre debe contener texto',
                            'apellido.regex' => 'El campo apellido debe contener texto',
                        //Mensajes de error de usuario
                            'usuario.unique' => 'Este usuario ya se encuentra registrado',
                        //Mensajes de error de cédula
                            'cedula.unique' => 'Esta cédula ya se encuentra registrada y asociada a un usuario',
                            'cedula.numeric' => 'El campo cédula debe contener números',
                            'cedula.digits_between' => 'El campo cédula debe contener al menos 10 caracteres',            
                        //Mensajes de error de email
                            'email.unique' => 'Este correo ya se encuentra asociado a un usuario',     
                            'email.email' => 'El campo correo debe contener un correo electrónico',     
                        //Mensajes de error de teléfono
                            'telefono.numeric' => 'El campo teléfono debe contener números',
                            'telefono.digits_between' => 'El campo teléfono debe contener hasta 10 caracteres'
                    ]);

                if($campos_validados){ 
                    //Ciframos la contraseña del usuario
                        $campos_validados['password'] = bcrypt($request->input('password'));

                    //Insertamos los valores en la tabla
                        Usuarios::create([
                            'usuario' => $campos_validados['usuario'],
                            'password'=> $campos_validados['password'],
                            'nombre'=> $campos_validados['nombre'],
                            'apellido'=> $campos_validados['apellido'],
                            'cedula'=> $campos_validados['cedula'],
                            'rol'=> $campos_validados['rol'],
                            'email'=> $campos_validados['email'],
                            'telefono'=> $campos_validados['telefono'],
                            'estado_usuario' => "activo",
                            'created_at' => $fecha_actual,
                            'updated_at' => "1970-01-01"
                        ]);

                    //Redireccionamos
                        return redirect()->route('usuarios.index')->with('resultado_creacion', 'Se ha creado el usuario correctamente');         
                }else{
                    return redirect()->back()->withErrors($campos_validados)->withInput();
                }      
         //Redireccionamos en caso de que el rol no sea un "administrador"   
            }else{
                return redirect()->route('medidores.index');
            } 
    }

    /**
     * Mostramos el formulario para editar un medidor
     */
    public function edit(Usuarios $usuariosItem)
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){ 

                //Retornaremos a la vista con el formulario
                   return view('usuarios.editar', [
                    'usuariosItem' => $usuariosItem
  
                   ]); 

           //Redireccionamos en caso de que el rol no sea un "administrador"   
            }else{
                return redirect()->route('medidores.index');
            } 
    }

    /**
     * Actualizamos el valor en la base de datos
     */
    public function update(Usuarios $usuariosItem, Request $request)
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){ 

                //Validamos los valores recibidos
                    $fecha_actual = date("Y-m-d H:i:s"); //Generamos una fecha actual
                    $campos_validados = request()->validate([
                        'usuario' => 'required|unique:usuarios,usuario,' . $usuariosItem->id,
                        'nombre' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                        'apellido' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                        'cedula' => 'required|numeric|digits_between:10,13,|unique:usuarios,cedula,' . $usuariosItem->id,
                        'rol' => 'required',
                        'email' => 'required|email|unique:usuarios,email,' . $usuariosItem->id,
                        'telefono' => 'required|numeric|digits_between:7,10',
                ],[
                    //Mensajes de error de usuario
                        'usuario.unique' => 'Este usuario ya se encuentra registrado',
                        'usuario.required' => 'El nombre de usuario es obligatorio',
                    //Mensajes de error de nombres
                        'nombre.regex' => 'El campo nombre debe contener texto',
                        'apellido.regex' => 'El campo apellido debe contener texto',            
                    //Mensajes de error de cédula
                        'cedula.numeric' => 'El campo cédula debe contener números',
                        'cedula.unique' => 'Esta cédula ya se encuentra asociada a un usuario',
                        'cedula.digits_between' => 'El campo cédula debe contener al menos 10 caracteres',  
                    //Mensajes de error de email
                        'email.email' => 'El campo correo debe contener un correo electrónico',     
                        'email.unique' => 'Este correo ya se encuentra asociado a un usuario',     
                    //Mensajes de error de teléfono
                        'telefono.numeric' => 'El campo teléfono debe contener números',
                        'telefono.required' => 'El campo teléfono es obligatorio',
                        'telefono.digits_between' => 'El campo teléfono debe contener hasta 10 caracteres'
                ]);

                if($campos_validados){
                //Realizamos la consulta Eloquent
                    Usuarios::where('id', $usuariosItem->id)
                            ->update([
                                'usuario' => request('usuario'),
                                'nombre' => request('nombre'),
                                'apellido' => request('apellido'),
                                'cedula' => request('cedula'),
                                'rol' => request('rol'),
                                'email' => request('email'),
                                'telefono' => request('telefono'),
                                'updated_at' => $fecha_actual
                            ]);
                //Redireccionamos 
                    return redirect()->route('usuarios.index')->with('resultado_edicion', 'El usuario se ha actualizado correctamente');

                }else{
                    return redirect()->back()->withErrors($campos_validados)->withInput();
                }   
        //Redireccionamos en caso de que el rol no sea un "administrador"   
            }else{
                return redirect()->route('medidores.index');
            } 

    }

    /**
     * Procesar la habilitación/inhabilitación del usuario
     */
    public function inhabilitar(Usuarios $usuariosItem)
    {
         //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){                     
                //Comprobamos si el usuario es un administrador
                    if ($usuariosItem->rol == 'administrador') {
                        return redirect()->route('usuarios.index')->with('error', 'No se puede realizar esta acción con un administrador, por favor actualice su rol e intente nuevamente.'); //Devolvemos el mensaje de error a la vista 'usuarios'
                    }else{
                        //Si el usuario no es un administrador, procedemos con la actualización de estado
                            //Comprobamos el estado del usuario y DESACTIVAMOS si se encuentra 'activo'
                                if ($usuariosItem->estado_usuario == "activo") {
                                        //Actualizamos el estado
                                            Usuarios::where('id', '=', $usuariosItem->id)->update([
                                                'estado_usuario' => 'inactivo'
                                            ]);
                                        //Redireccionamos
                                           return redirect()->route('usuarios.index')->with('resultado', 'Se ha inhabilitado el usuario correctamente');

                            //Comprobamos el estado del usuario y ACTIVAMOS si se encuentra 'inactivo'   
                                    }elseif($usuariosItem->estado_usuario == "inactivo"){
                                        //Actualizamos el estado
                                            Usuarios::where('id', '=', $usuariosItem->id)->update([
                                                'estado_usuario' => 'activo'
                                            ]);
                                        //Redireccionamos
                                           return redirect()->route('usuarios.index')->with('resultado', 'Se ha habilitado el usuario correctamente');
                                    }


                    }
          //Redireccionamos en caso de que el rol no sea un "administrador"   
            }else{
                return redirect()->route('medidores.index');
            } 
    }

    /**
    * Mostrar formulario para actualizar contraseña
    */
    public function actualizarPasswordForm()
    {
        return view('usuarios.password');
    }

    /**
    * Procesar actualización de contraseña
    */
    public function actualizarPassword(Request $request)
    {
        //Recibimos y validamos los valores ingresados
            $campos_validados = request()->validate([
                'password_actual' => 'required',
                'password_nueva' => 'required'
        ],[
            //Mensajes de error de contraseña
                'password_actual.required' => 'El campo de contraseña actual es obligatorio',
                'password_nueva.required' => 'El campo de contraseña nueva es obligatorio',
        ]);
        if ($campos_validados) {
            $fecha_actual = date("Y-m-d H:i:s");
        //Ingresamos valores en variables
            $password_actual = $campos_validados['password_actual'];
            $password_nueva = bcrypt($campos_validados['password_nueva']);
            $id_usuario = session()->get('sesion')['id'];

         //Realizamos la consulta para validar el usuario actual
            $usuarioEncontrado = Usuarios::where('id', $id_usuario)->first();
            if ($usuarioEncontrado && password_verify($password_actual, $usuarioEncontrado->password)) {   
                //Realizamos la actualización de la contraseña
                Usuarios::where('id', $id_usuario)
                    ->update([
                        'password' => $password_nueva,
                        'updated_at' => $fecha_actual
                    ]);   

         //Cerramos la sesión y redireccionamos
                //Limpamos las sesiones existentes
                    session()->flush(); 
                //Redireccionamos a la pagina de inicio de sesión
                    return redirect()->route('login')->with('resultado_update', 'La contraseña se ha actualizado correctamente, por favor inicia sesión nuevamente'); 

            }else{
              // Redireccionamos al login si hay algún error en la validación
                 return redirect()->back()->with('resultado_validacionPassword', 'La contraseña actual es incorrecta')->withInput();
            }

         }else{
           return redirect()->back()->withErrors($campos_validados)->withInput();
         } 
     }
}

