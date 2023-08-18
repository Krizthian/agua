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
     * Mostramos el formulario para crear un nuevo usuario
     */
    public function create()
    {
         return view('usuarios.crear'); //Retornaremos a la vista con el formulario
    }

    /**
     * Ingresamos el usuario en la base de datos
     */
    public function store(Request $request)
    {
        //Validamos los valores recibidos
            $campos_validados = request()->validate([
                'usuario' => 'required|unique:usuarios',
                'password' => 'required',
                'nombre' => 'required',
                'apellido' => 'required',
                'cedula' => 'required|unique:usuarios|numeric',
                'rol' => 'required',
                'email' => 'required|email|unique:usuarios',
                'telefono' => 'required|numeric',
            ],[
                //Mensajes de error de usuario
                    'usuario.unique' => 'Este usuario ya se encuentra registrado',
                //Mensajes de error de cédula
                    'cedula.unique' => 'Esta cédula ya se encuentra registrada y asociada a un usuario',
                    'cedula.numeric' => 'El campo cédula debe contener números',
                //Mensajes de error de email
                    'email.unique' => 'Este correo ya se encuentra registrado y asociado a un usuario',     
                    'email.email' => 'El campo correo debe contener un correo electrónico',     
                //Mensajes de error de teléfono
                    'telefono.numeric' => 'El campo teléfono debe contener números',
            ]);

        if($campos_validados){
            //Insertamos los valores en la tabla
                Usuarios::create($campos_validados);

            //Redireccionamos
                return redirect()->route('usuarios.index')->with('resultado_creacion', 'Se ha creado el usuario correctamente');         
        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }      
    }

    /**
     * Mostramos el formulario para editar un medidor
     */
    public function edit(Usuarios $usuariosItem)
    {
        //Retornaremos a la vista con el formulario
           return view('usuarios.editar', [
            'usuariosItem' => $usuariosItem
           ]); 
    }

    /**
     * Actualizamos el valor en la base de datos
     */
    public function update(Usuarios $usuariosItem)
    {
        //Validamos los valores recibidos
            $campos_validados = request()->validate([
                'usuario' => 'required',
                'password' => 'required',
                'nombre' => 'required',
                'apellido' => 'required',
                'cedula' => 'required|numeric',
                'rol' => 'required',
                'email' => 'required|email',
                'telefono' => 'required|numeric',
        ],[
            //Mensajes de error de cédula
                'cedula.numeric' => 'El campo cédula debe contener números',
            //Mensajes de error de email
                'email.email' => 'El campo correo debe contener un correo electrónico',     
            //Mensajes de error de teléfono
                'telefono.numeric' => 'El campo teléfono debe contener números',
        ]);

        if($campos_validados){
        //Realizamos la consulta Eloquent
            Usuarios::where('id', $usuariosItem->id)
                    ->update([
                        'usuario' => request('usuario'),
                        'password' => request('password'),
                        'nombre' => request('nombre'),
                        'apellido' => request('apellido'),
                        'cedula' => request('cedula'),
                        'rol' => request('rol'),
                        'email' => request('email'),
                        'telefono' => request('telefono'),
                    ]);
        //Redireccionamos 
            return redirect()->route('usuarios.index')->with('resultado_edicion', 'El usuario se ha actualizado correctamente');

        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }       
    }

    /**
     * Eliminar el valor en la base de datos
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
                return redirect()->route('usuarios.index')->with('resultado', 'El usuario ha sido eliminado'); //Devolvemos el mensaje de resultados a la vista 'usuarios'
            }
    }
}
