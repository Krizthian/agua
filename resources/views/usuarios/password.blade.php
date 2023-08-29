@extends('layouts.layout_panel')
<title>Actualizar Contraseña | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
<style>
  /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (PAGINA DE INICIO)*/
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
    }
    .bg-body-tertiary {
      --bs-bg-opacity: 1;
      background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;

    }   
</style>
<center><h1 class="display-4">ACTUALIZAR CONTRASEÑA</h1></center>
<main class="form-signin w-100 m-auto">
  <form action="{{route('actualizarPassword')}}" method="POST">
  	@csrf
      <!--INICIO DE MENSAJE DE RESULTADO DE VALIDACION-->
        @if(session('resultado_validacionPassword'))
          <div class="alert alert-danger alert-dismissible fade show">
              La <strong>contraseña actual</strong> es incorrecta.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE VALIDACION-->  
      <!--INICIO DE MENSAJE DE RESULTADO DE CONFIRMACION-->
        @if(session('resultado_actualizacion'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha actualizado la <strong>contraseña</strong> correctamente.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE CONFIRMACION--> 
      <!--INICIO DE MENSAJE DE RESULTADO DE VALIDACION DE CAMPOS-->
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
      <!--FIN DE MENSAJE DE RESULTADO DE VALIDACION DE CAMPOS-->                 
    <div class="form-floating">
      <input type="password" class="form-control" id="password_actual" name="password_actual" placeholder="Contraseña actual" required>
      <label for="password_actual">Contraseña actual</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password_nueva" name="password_nueva" placeholder="Contraseña nueva" required>
      <label for="password_nueva">Contraseña nueva</label>
    </div>    
    <button class="btn btn-success w-100 py-2" type="submit"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>  	
  </form>
</main>
@endsection('content')