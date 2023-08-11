@if(isset(session()->get('sesion')['usuario']) && session()->get('sesion')['rol'] != 'administrador')
  <script>
    window.location = "/panel";
  </script>
@else
@extends('layouts.layout_panel')
<title>Ajustes del Sistema | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
   <style>
        /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (USUARIOS)*/
        table th {
            text-align: center; 
        }
        .td_acciones{
            text-align: center;
        }
        .container{
            background-color: #ecf0f1;
            border-radius: 6px 6px 6px 6px;
            -moz-border-radius: 6px 6px 6px 6px;
            -webkit-border-radius: 6px 6px 6px 6px;
            border: 0px solid #000000;
            width:50%;
    }
    .bg-body-tertiary {
        --bs-bg-opacity: 1;
         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
     }
    </style>

<!--SECCION DE ACTUALIZACION DE TARIFAS-->
<center><h1 class="display-4">ACTUALIZACIÓN DE TARIFAS</h1></center>
    <div class="container">
      <br>
        <main class="form-signin w-100 m-auto">
         <form action="{{route('tarifas.update')}}" method="POST">
          @csrf @method('PATCH')
          <!--DEVOLVEMOS MENSAJES DE ERROR-->
              @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Error de validación</strong><br>
                        <ul>
                          @foreach ($errors->all() as $error)          
                              <li>{{ $error }}</li>
                             @endforeach   
                        </ul>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>       
                  </div>
              @endif
          <!--FIN DE MENSAJES DE ERROR-->
            <!--INICIO DE MENSAJE DE RESULTADO DE INGRESO-->
                      @if(session('resultados_tarifas'))
                        <div class="alert alert-success alert-dismissible fade show">
                            Se ha actualizado las <strong>tarifas</strong> correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                      @endif  
          <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->
           <div class="col-auto">
            @foreach ($tarifas as $tarifasItem)
                  <strong><label>0-15 m<sup>3</sup>:</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control"  name="rango_0_15" value="{{$tarifasItem->tarifa_a}}" placeholder="{{$tarifasItem->tarifa_a}}" required>
                  </div></center>

                  <strong><label>16-30 m<sup>3</sup>:</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control" name="rango_16_30" value="{{$tarifasItem->tarifa_b}}" placeholder="{{$tarifasItem->tarifa_b}}" required>
                  </div></center>

                  <strong><label>31-60 m<sup>3</sup>:</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control" name="rango_31_60" value="{{$tarifasItem->tarifa_c}}" placeholder="{{$tarifasItem->tarifa_c}}" required>
                  </div></center>

                  <strong><label>61-100 m<sup>3</sup>:</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control" name="rango_61_100" value="{{$tarifasItem->tarifa_d}}" placeholder="{{$tarifasItem->tarifa_d}}" required>
                  </div></center>

                  <strong><label>101-300 m<sup>3</sup>:</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control" name="rango_101_300" value="{{$tarifasItem->tarifa_e}}" placeholder="{{$tarifasItem->tarifa_e}}" required>
                  </div></center>

                  <strong><label>301-2500 m<sup>3</sup>:</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control" name="rango_301_2500" value="{{$tarifasItem->tarifa_f}}" placeholder="{{$tarifasItem->tarifa_f}}" required>
                  </div></center>

                  <strong><label>2501-5000 m<sup>3</sup>:</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control" name="rango_2501_5000" value="{{$tarifasItem->tarifa_g}}" placeholder="{{$tarifasItem->tarifa_g}}" required>
                  </div></center>

                  <strong><label>5000 m<sup>3</sup> en adelante :</label><center></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><b>$</b></span>
                      <input type="text" class="form-control" name="rango_5000" value="{{$tarifasItem->tarifa_h}}" placeholder="{{$tarifasItem->tarifa_h}}" required>
                  </div></center>
            @endforeach
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Actualizar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
      </div>
        <br>

        <!--FIN DE TABLA CON VALORES-->
    </div>
<!--FIN DE SECCION DE ACTUALIZACION DE TARIFAS-->

@endsection('content')

@endif