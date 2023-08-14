<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medidores; //Importamos el modelo de la tabla 'medidores'
use App\Models\Consumos; //Importamos el modelo de la tabla 'consumos'
use App\Models\Planillas; //Importamos el modelo de la tabla 'planillas'
use App\Models\Clientes; //Importamos el modelo de la tabla 'clientes'
use App\Models\Tarifas; //Importamos el modelo de la tabla 'tarifas'

class MedidoresController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
        //Realizamos la obtencion de datos considerando la existencia de la tabla 'consumos'
            $consumoMedidor = Medidores::with('consumo')->paginate(10); 
        //Retornamos los valores obtenidos a la vista    
            return view('medidores', ['consumoMedidor' => $consumoMedidor]);
    }
    
    /**
     * Busqueda de Medidodres
    */

    public function busqueda(Request $request)
    {
        //Obtenemos los valores del formulario anterior
            $valores = $request->input('valores');       
        //Consulta Eloquent
                $query = Medidores::query();
        //Verificamos si se recibio un valor        
            if(isset($valores)){
                $query->where('numero_medidor', $valores);
            }
        //Ejecutamos la consulta
            $consumoMedidor = $query->paginate(10); //Solicitamos un maximo de valores para el paginado  

        //Retornamos los valores
            return view('medidores', compact('consumoMedidor'));              
          
    }

    /**
     * Mostramos el formulario para crear un nuevo medidor
    */
    public function create()
    {
    //Realizamos la consulta para obtener la informacion de los clientes registrados
        $queryClientes = Clientes::with('medidor')->orderBy('apellido')->get();
    //Retornaremos a la vista con el formulario    
        return view('medidores.crear', compact('queryClientes')); 
    }

    /**
     * Ingresamos el medidor en la base de datos
    */
    public function store(Request $request)
    {
        //Obtenemos valores
            $id_cliente = $request->input('id_cliente');
        //Validamos los valores recibidos
        $campos_validados = request()->validate([
            'fecha_instalacion' => 'required',
            'ubicacion' => 'required',
            'numero_medidor' => 'required|numeric|min:0|unique:medidores,numero_medidor',
        ],[
            'ubicacion.required' => 'El campo de ubicación es obligatorio',
            'numero_medidor.numeric' => 'El campo de número de medidor debe contener números',
            'numero_medidor.min' => 'El valor mínimo para el campo de número de medidor es 0',
            'numero_medidor.required' => 'El campo de número de medidor es obligatorio',
            'numero_medidor.unique' => 'Este medidor ya se encuentra registrado',
        ]);

        if ($campos_validados) {
        //Insertamos los valores en la tabla
            Medidores::create([
                'id_cliente' => $id_cliente,
                'fecha_instalacion' => $campos_validados['fecha_instalacion'],
                'ubicacion' => $campos_validados['ubicacion'],
                'numero_medidor' => $campos_validados['numero_medidor'],
            ]);
        //Redireccionamos
            return redirect()->route('medidores.index')->with('resultado_creacion', 'Se ha creado el medidor correctamente'); 
        }else{
            return redirect()->back()->withErrors($campos_validados)->withInput();
        }
   
    }

    /**
     * Redireccionar al formulario de actualización de medidor
    */

    public function edit(Medidores $consumoMedidorItem)
    {
        //Obtenemos información de los clientes
            $queryClientes = Clientes::with('medidor')->orderBy('apellido')->get();
        //Devolvemos todo lo obtenido al formulario de ingreso
            return view('medidores.editar', [
                'consumoMedidorItem' => $consumoMedidorItem,
                'queryClientes' => $queryClientes
            ]);

    } 

    public function update(Request $request, Medidores $consumoMedidorItem)
    {
        //Obtenemos valores
            $id_medidor = $consumoMedidorItem->id;
            $id_cliente = $request->input('id_cliente');
        //Validamos los valores recibidos
            $campos_validados = request()->validate([
                'ubicacion' => 'required',
                'id_cliente' => 'required',
            ],[
                'ubicacion.required' => 'El campo de ubicación es obligatorio',
                'id_cliente.required' => 'El campo de propietario es obligatorio',
            ]);
        //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                //Actualizamos los valores en la tabla de medidores
                    Medidores::where('id', $id_medidor)
                       ->update([
                        'id_cliente' => $id_cliente,
                        'ubicacion' => $campos_validados['ubicacion']
                       ]);
                //Actualizamos los valores en la tabla de planilla       
                     Planillas::where('id_medidor', $id_medidor)
                       ->update([
                        'id_cliente' => $id_cliente
                       ]);
        //Redireccionamos
            return redirect()->route('medidores.index')->with('resultado_actualizacion', 'Se ha actualizado la información del medidor correctamente'); 

            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }   
    }

    /**
     * Redireccionar al formulario de ingreso de consumos
    */

    public function ingresarConsumo(Medidores $consumoMedidorItem)
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'administrador'){            
            //Devolvemos todo lo obtenido al formulario de ingreso
                return view('medidores.consumos', [
                    'consumoMedidorItem' => $consumoMedidorItem
                ]);
        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'personal'){
                return redirect()->route('medidores.index');
            }                   

    }

    /**
     * Almacenar los nuevos consumos
    */

    public function almacenarConsumo(Medidores $consumoMedidorItem)
    {
        //Obtenemos los valores desde el formulario anterior
            $id_medidor = $consumoMedidorItem->id;
            $id_cliente = $consumoMedidorItem->id_cliente;
            $consumo_actual = request('consumo_actual');
            $fecha_lectura_actual = date("Y-m-d"); //Generamos una fecha actual
            $consumo_anterior = request('consumo_anterior');
            $fecha_lectura_anterior = request('fecha_lectura_anterior');
            $responsable = request('responsable'); 

        //Validamos los valores recibidos desde el formulario anterior    
            $campos_validados = request()->validate([
                'consumo_actual' => 'required|numeric|min:0',
                'responsable' => 'required',
            ],[
                //Mensajes de error valor numerico y requerido
                    //Consumo Actual
                        'consumo_actual.numeric' => 'Se requiere un valor numérico para el campo de consumo actual',
                        'consumo_actual.min' => 'El valor mínimo para el campo de consumo actual es 0',
                        'consumo_actual.required' => 'El consumo actual es obligatorio',
                    //Responsable
                        'responsable.required' => 'El nombre del responsable es obligatorio'    

            ]);

        //Valores para la tabla de planillas
            //La factura se genera dos dias despues de la lectura
                $fecha_factura = date('Y-m-d', strtotime('+2 days', strtotime($fecha_lectura_actual)));
            //La fecha maxima de pago previo a que se suspenda el servicio es 5 dias despues de la fecha de factura    
                $fecha_maxima =  date('Y-m-d', strtotime('+5 days', strtotime($fecha_factura))); 
            //Obtenemos los rangos de tarifas desde la tabla 'tarifas'
                $tarifas = Tarifas::all();
                    $tarifa_0_15 = $tarifas->pluck('tarifa_a')->first();
                    $tarifa_16_30 = $tarifas->pluck('tarifa_b')->first();
                    $tarifa_31_60 = $tarifas->pluck('tarifa_c')->first();
                    $tarifa_61_100 = $tarifas->pluck('tarifa_d')->first();
                    $tarifa_101_300 = $tarifas->pluck('tarifa_e')->first();
                    $tarifa_301_2500 = $tarifas->pluck('tarifa_f')->first();
                    $tarifa_2501_5000 = $tarifas->pluck('tarifa_g')->first();
                    $tarifa_5000 = $tarifas->pluck('tarifa_h')->first(); 

            //Realizamos el calculo de consumos en funcion de las tarifas e ingresarmos el valor en la variable valor_actual
               switch (true) {
                    case ($consumo_actual >= 0 && $consumo_actual <= 15):
                        $valor_actual = $consumo_actual * $tarifa_0_15;
                        break;
                    case ($consumo_actual >= 16 && $consumo_actual <= 30):
                        $valor_actual = $consumo_actual * $tarifa_16_30;
                        break;
                    case ($consumo_actual >= 31 && $consumo_actual <= 60):
                        $valor_actual = $consumo_actual * $tarifa_31_60;
                        break;
                    case ($consumo_actual >= 61 && $consumo_actual <= 100):
                        $valor_actual = $consumo_actual * $tarifa_61_100;
                        break;
                    case ($consumo_actual >= 101 && $consumo_actual <= 300):
                        $valor_actual = $consumo_actual *  $tarifa_101_300;
                        break;
                    case ($consumo_actual >= 301 && $consumo_actual <= 2500):
                        $valor_actual = $consumo_actual * $tarifa_301_2500;
                        break;
                    case ($consumo_actual >= 2501 && $consumo_actual <= 5000):
                        $valor_actual = $consumo_actual * $tarifa_2501_5000;
                        break;
                    case ($consumo_actual > 5000):
                        $valor_actual = $consumo_actual * $tarifa_5000;
                        break;
                }

         //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                //Validamos si existe un medidor en la tabla 'consumos'
                    $id_medidorExistente = Consumos::where('id_medidor', $id_medidor)->exists();
                    if ($id_medidorExistente) {            
                        //Obtenemos valores de la tabla planillas
                            $planillaValorActual = Planillas::where('id_medidor', $id_medidor)
                                ->pluck('valor_actual')
                                ->first();
                         //Comprobamos si existe una deuda pendiente
                                /*
                                    Vamos a comprobar si existe una deuda pendiente,
                                    si ese es el caso, entonces continuaremos sumando el valor
                                    anterior en conjunto con el nuevo, por lo que el valor a pagar
                                    irá en incremento
                                */
                            if ($planillaValorActual > 0) {
                                //Sumamos valores
                                 $valorDeuda = $planillaValorActual + $valor_actual;                                
                                Consumos::where('id_medidor', $id_medidor)
                                       ->update([
                                        'consumo_actual' => $consumo_actual,
                                        'fecha_lectura_actual' => $fecha_lectura_actual,
                                        'consumo_anterior' => $consumo_anterior,
                                        'fecha_lectura_anterior' => $fecha_lectura_anterior,
                                        'responsable' => $responsable
                                       ]);

                                Planillas::where('id_medidor', $id_medidor)
                                       ->update([
                                        'valor_actual' => $valorDeuda,
                                        'fecha_factura' => $fecha_factura,
                                        'fecha_maxima' => $fecha_maxima,
                                        'estado_servicio' => "inactivo"

                                    ]);              
                         //Si no hay una deuda pendiente, continuamos con normalidad                                           
                            }elseif($planillaValorActual == 0){
                                   Consumos::where('id_medidor', $id_medidor)
                                   ->update([
                                    'consumo_actual' => $consumo_actual,
                                    'fecha_lectura_actual' => $fecha_lectura_actual,
                                    'consumo_anterior' => $consumo_anterior,
                                    'fecha_lectura_anterior' => $fecha_lectura_anterior,
                                    'responsable' => $responsable
                                   ]);

                                   Planillas::where('id_medidor', $id_medidor)
                                   ->update([
                                    'valor_actual' => $valor_actual,
                                    'fecha_factura' => $fecha_factura,
                                    'fecha_maxima' => $fecha_maxima

                                   ]);
                            }       
                   }else{
                    //Creamos el consumo si aun no existe
                        $consumoCreado = Consumos::create([
                        'id_medidor' => $id_medidor,
                        'consumo_actual' => $consumo_actual,
                        'fecha_lectura_actual' => $fecha_lectura_actual,
                        'consumo_anterior' => $consumo_anterior,
                        'fecha_lectura_anterior' => $fecha_lectura_anterior,
                        'responsable' => $responsable
                       ]);
                        //Obtenemos el id de consumo para la creacion de la planilla
                            $id_consumoCreado = $consumoCreado->id;
                        //Creamos la nueva planilla    
                            Planillas::create([
                            'id_cliente' => $id_cliente,
                            'id_medidor' => $id_medidor,
                            'id_consumo' => $id_consumoCreado,
                            'valor_actual' => $valor_actual,
                            'fecha_factura' => $fecha_factura,
                            'fecha_maxima' => $fecha_maxima,
                            'estado_servicio' => "activo"   
                       ]);
                        //Redireccionamos y devolvemos variables
                        return redirect()->route('medidores.index')->with([
                            'resultado_ingresoPlanilla' => 'Los consumos se han ingresado correctamente y se ha creado una nueva planilla',
                        ]);    
                   }
          //Redireccionamos y devolvemos variables
                return redirect()->route('medidores.index')->with([
                    'resultado_ingreso' => 'Los consumos se han ingresado correctamente',
                ]);         
            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }

    }
 /**
     * Devolver resultados a la pagina de tarifas
     */
    public function mostrarTarifas()
    {
        //Comprobamos el rol antes de devolver la vista
            if(session()->get('sesion')['rol'] == 'administrador'){
                $tarifas = Tarifas::all();
                return view('medidores.tarifas', compact('tarifas'));

        //Redireccionamos en caso de que el rol no sea un "personal" o "administrador"   
            }elseif(session()->get('sesion')['rol'] == 'supervisor' || session()->get('sesion')['rol'] == 'personal'){
                return redirect()->route('medidores.index');
            }    
    }

    public function actualizarTarifas(Request $request)
    {
        //Realizamos la validacion de campos
            $campos_validados = request()->validate([
                'rango_0_15' => 'required|numeric|min:0',
                'rango_16_30' => 'required|numeric|min:0',
                'rango_31_60' => 'required|numeric|min:0',
                'rango_61_100' => 'required|numeric|min:0',
                'rango_101_300' => 'required|numeric|min:0',
                'rango_301_2500' => 'required|numeric|min:0',
                'rango_2501_5000' => 'required|numeric|min:0',
                'rango_5000' => 'required|numeric|min:0',
            ],[
                // Mensajes de error valor numérico
                    'rango_0_15.numeric' => 'Se requiere un valor numérico para el campo de 0-15 metros cúbicos',
                    'rango_16_30.numeric' =>'Se requiere un valor numérico para el campo de 16-30 metros cúbicos',
                    'rango_31_60.numeric' =>'Se requiere un valor numérico para el campo de 31-60 metros cúbicos',
                    'rango_61_100.numeric' =>'Se requiere un valor numérico para el campo de 61-100 metros cúbicos',
                    'rango_101_300.numeric' =>'Se requiere un valor numérico para el campo de 101-300 metros cúbicos',
                    'rango_301_2500.numeric' =>'Se requiere un valor numérico para el campo de 301-2500 metros cúbicos',
                    'rango_2501_5000.numeric' =>'Se requiere un valor numérico para el campo de 2501-5000 metros cúbicos',
                    'rango_5000.numeric' =>'Se requiere un valor numérico para el campo de 5000 en adelante metros cúbicos',
                // Mensajes de error valor requerido
                    'rango_0_15.required' => 'El campo de 0-15 metros cúbicos es obligatorio',
                    'rango_16_30.required' =>'El campo de 16-30 metros cúbicos es obligatorio',
                    'rango_31_60.required' =>'El campo de 31-60 metros cúbicos es obligatorio',
                    'rango_61_100.required' =>'El campo de 61-100 metros cúbicos es obligatorio',
                    'rango_101_300.required' =>'El campo de 101-300 metros cúbicos es obligatorio',
                    'rango_301_2500.required' =>'El campo de 301-2500 metros cúbicos es obligatorio',
                    'rango_2501_5000.required' =>'El campo de 2501-5000 metros cúbicos es obligatorio',
                    'rango_5000.required' =>'El campo de 5000 en adelante metros cúbicos es obligatorio',
                // Mensajes de error valor mínimo
                    'rango_0_15.min' => 'El valor mínimo para el campo de 0-15 metros cúbicos es 0',
                    'rango_16_30.min' => 'El valor mínimo para el campo de 16-30 metros cúbicos es 0',
                    'rango_31_60.min' => 'El valor mínimo para el campo de 31-60 metros cúbicos es 0',
                    'rango_61_100.min' => 'El valor mínimo para el campo de 61-100 metros cúbicos es 0',
                    'rango_101_300.min' => 'El valor mínimo para el campo de 101-300 metros cúbicos es 0',
                    'rango_301_2500.min' => 'El valor mínimo para el campo de 301-2500 metros cúbicos es 0',
                    'rango_2501_5000.min' => 'El valor mínimo para el campo de 2501-5000 metros cúbicos es 0',
                    'rango_5000.min' => 'El valor mínimo para el campo de 5000 en adelante metros cúbicos es 0',
            ]);
         //Comprobamos si los campos han sido validados
            if ($campos_validados) {
                       Tarifas::where('id', '1')
                       ->update([
                        'tarifa_a' => $campos_validados['rango_0_15'],
                        'tarifa_b' => $campos_validados['rango_16_30'],
                        'tarifa_c' => $campos_validados['rango_31_60'],
                        'tarifa_d' => $campos_validados['rango_61_100'],
                        'tarifa_e' => $campos_validados['rango_101_300'],
                        'tarifa_f' => $campos_validados['rango_301_2500'],
                        'tarifa_g' => $campos_validados['rango_2501_5000'],
                        'tarifa_h' => $campos_validados['rango_5000'],
                    ]);
            return redirect()->back()->with('resultados_tarifas', 'Tarifas actualizadas correctamente.');

            }else{
                return redirect()->back()->withErrors($campos_validados)->withInput();
            }   

    }
 
}