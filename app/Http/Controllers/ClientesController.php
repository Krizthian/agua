<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){        
                $clientes = Clientes::with('medidor')->paginate(10); 
                return view('clientes', ['clientes' => $clientes]);
        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
            }     
    }
    
    /**
     * Busqueda de Clientes
     */

    public function busqueda(Request $request)
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){  
                //Obtenemos los valores del formulario anterior
                    $valores = $request->input('valores');
                
                //Consulta Eloquent
                        $query = Clientes::query();

                //Verificamos si se recibio un valor        
                    if(isset($valores)){
                        $query->where('cedula', $valores)
                            ->orWhere('nombre', 'LIKE', '%' . $valores . '%') //Ajustamos la busqueda para que no requiera valores exactos
                            ->orWhere('apellido', 'LIKE', '%' . $valores . '%') //Ajustamos la busqueda para que no requiera valores exactos
                            ->orWhere('cedula', $valores);
                    }   

                //Ejecutamos la consulta
                    $clientes = $query->paginate(20); //Solicitamos un maximo de valores para el paginado  

                //Retornamos los valores
                    return view('clientes', compact('clientes'));              

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
            }  
    }
    /**
     * Mostramos el formulario para crear un nuevo cliente
     */
    public function create()
    {
    //Comprobamos el rol antes de devolver la vista
        if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){   
            return view('clientes.crear'); //Retornaremos a la vista con el formulario
    //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
            }  
    }

    /**
     * Ingresamos el cliente en la base de datos
     */
    public function store(Request $request)
    {
    //Obtenemos la fecha actual
        $fecha = date("Y-m-d");    
    //Comprobamos el rol antes de devolver la vista
        if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){           
                //Validamos los valores recibidos
                $campos_validados = request()->validate([
                    'nombre' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                    'apellido' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                    'cedula' => 'required|numeric|digits_between:10,13|unique:clientes',
                    'direccion' => 'required',
                    'email' => 'required|email|unique:clientes',
                    'telefono' => 'required|numeric|digits_between:7,10',

                ],[
                    'nombre.regex' => 'El campo nombre debe contener texto',
                    'apellido.regex' => 'El campo apellido debe contener texto',
                    'cedula.numeric' => 'El campo cédula debe contener números',
                    'cedula.required' => 'El campo cédula es obligatorio',
                    'cedula.unique' => 'Esta cédula ya se encuentra asociada a un cliente',
                    'cedula.digits_between' => 'El campo cédula debe contener al menos 10 caracteres',            
                    'telefono.numeric' => 'El campo teléfono debe contener números',
                    'telefono.digits_between' => 'El campo teléfono debe contener hasta 10 caracteres',

                    'email.unique' => 'Este correo electrónico ya se encuentra asociado a un cliente',
                    'email.email' => 'El campo de correo electrónico debe contener un correo electrónico',
                    'email.required' => 'El campo de correo electrónico es obligatorio',
                ]);
                if ($campos_validados) {
                //Insertamos los valores en la tabla
                    Clientes::create([
                        'nombre' => $campos_validados['nombre'],
                        'apellido' => $campos_validados['apellido'],
                        'cedula' => $campos_validados['cedula'],
                        'direccion' => $campos_validados['direccion'],
                        'email' => $campos_validados['email'],
                        'telefono' => $campos_validados['telefono'],
                        'resp_creacion' => session()->get('sesion')['nombres'],
                        'fecha_creacion' => $fecha
                    ]);
                //Redireccionamos
                    return redirect()->route('clientes.index')->with('resultado_creacion', 'Se ha creado el Cliente correctamente'); 
                }else{
                    return redirect()->back()->withErrors($campos_validados)->withInput();
                }
    //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
        }     
   
    }

    /**
     * Mostramos el formulario para editar un cliente
     */
    public function edit(Clientes $clientesItem)
    {
    //Comprobamos el rol antes de devolver la vista
        if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){              
            //Retornaremos a la vista con el formulario
               return view('clientes.editar', [
                'clientesItem' => $clientesItem
               ]); 
    //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
        }     
    }

    /**
     * Actualizamos el valor en la base de datos
     */
    public function update(Clientes $clientesItem)
    {
    //Comprobamos el rol antes de devolver la vista
        if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador'){            
            //Validamos los valores recibidos
                $campos_validados = request()->validate([
                    'nombre' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                    'apellido' => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑ\s]+$/u',
                    'cedula' => 'required|numeric|digits_between:10,13|unique:clientes,cedula,' . $clientesItem->id,
                    'direccion' => 'required',
                    'email' => 'required|email|unique:clientes,email,' . $clientesItem->id,
                    'telefono' => 'required|numeric|digits_between:7,10',
                ],[
                    'nombre.regex' => 'El campo nombre debe contener texto',
                    'apellido.regex' => 'El campo apellido debe contener texto',            
                    'cedula.numeric' => 'El campo cédula debe contener números',
                    'cedula.required' => 'El campo cédula es obligatorio',
                    'cedula.unique' => 'Esta cédula ya se encuentra asociada a un cliente', 
                    'cedula.digits_between' => 'El campo cédula debe contener al menos 10 caracteres',           
                    'telefono.numeric' => 'El campo teléfono debe contener números',
                    'telefono.digits_between' => 'El campo teléfono debe contener hasta 10 caracteres',

                    'email.unique' => 'Este correo electrónico ya se encuentra asociado a un cliente',
                    'email.email' => 'El campo de correo electrónico debe contener un correo electrónico',
                    'email.required' => 'El campo de correo electrónico es obligatorio',
                ]);
                if ($campos_validados) {
                    //Realizamos la consulta Eloquent
                        Clientes::where('id', $clientesItem->id)
                                ->update([
                                    'nombre' => $campos_validados['nombre'],
                                    'apellido' => $campos_validados['apellido'],
                                    'cedula' => $campos_validados['cedula'],
                                    'direccion' => $campos_validados['direccion'],
                                    'email' => $campos_validados['email'],
                                    'telefono' => $campos_validados['telefono'],
                                ]);
                    //Redireccionamos 
                        return redirect()->route('clientes.index')->with('resultado_edicion', 'El Cliente se ha actualizado correctamente');
                 }else{
                    return redirect()->back()->withErrors($campos_validados)->withInput();
                }                      
    //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
        }elseif(session()->get('sesion')['rol'] == 'supervisor'){
                return redirect()->route('medidores.index');
        }   
    }

    /**
     * Listar todos los medidores asociados a un cliente
    */

    public function listar(Clientes $clientesItem)
    { 
           //Ejecutamos la consulta Eloquent 
                $medidores = Medidores::where('id_cliente', $clientesItem->id)->get();
            //Retornaremos a la vista con los valores
               return view('clientes.medidores', [
                'clientesItem' => $clientesItem,
                'medidores' => $medidores
               ]);         
    }

}
