@if(isset(session()->get('sesion')['usuario']) && session()->get('sesion')['rol'] != 'administrador')
  <script>
    window.location = "/panel";
  </script>
@else
@extends('layouts.layout_panel')
<title>Actualización de cargos | Sistema de Consultas de Valores a Pagar del Agua</title>
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

<!--SECCION DE ACTUALIZACION DE CARGOS-->
<center><h1 class="display-4">ACTUALIZACIÓN DE CARGOS</h1></center>
    <div class="container">
      <br>
       <!--BOTON DE REGRESAR-->
            <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('medidores.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
            </svg></a></div><br><br>
      <!--FIN DE BOTON DE REGRESAR-->
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
                      @if(session('resultados_cargos'))
                        <div class="alert alert-success alert-dismissible fade show">
                            Se ha actualizado los <strong>cargos</strong> correctamente.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                      @endif  
          <!--FIN DE MENSAJE DE RESULTADO DE INGRESO-->      
        <main class="w-100 m-auto">
         <form action="{{route('cargos.update')}}" method="POST" class="row g3">
          @csrf @method('PATCH')
            @foreach ($cargos as $cargosItem)
            <div class="col-md-6 mb-2">
                  <strong><label>Porcentaje por alcantarillado</label></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><i class="fa-solid fa-percent fa-sm"></i></span>
                      <input type="text" pattern="\d+(\.\d{1,2})?" class="form-control @error('alcantarillado') is-invalid @enderror"  name="alcantarillado" value="{{ sprintf('%.0f', $cargosItem->alcantarillado * 100) }}" placeholder="{{ sprintf('%.0f', $cargosItem->alcantarillado * 100) }}" required>
                  </div>
             </div>
              <div class="col-md-6 mb-2">
                  <strong><label>Valor por administración</label></strong>
                  <div class="input-group mb-2">
                      <span class="input-group-text"><i class="fa-solid fa-dollar-sign fa-sm"></i></span>
                      <input type="text" class="form-control @error('administracion') is-invalid @enderror"  name="administracion" value="{{$cargosItem->administracion}}" placeholder="{{$cargosItem->administracion}}" required>
                  </div>
             </div>   
            @endforeach
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Actualizar</button></center></div>
          <br>
        </form>
    </main>
        <br><br>
      </div>
        <br>
        <!--FIN DE TABLA CON VALORES-->
    </div>
<!--FIN DE SECCION DE ACTUALIZACION DE CARGOS-->

@endsection('content')

@endif