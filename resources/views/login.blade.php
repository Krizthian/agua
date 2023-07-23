@if(isset(session()->get('sesion')['usuario']))
  <script>
    window.location = "/panel";
  </script>
@else
@extends('layouts.layout_home')
<title>Inicio de Sesión | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
<center><h1 ><strong>INICIAR SESIÓN</strong></h1></center>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<main class="form-signin w-100 m-auto">
  <form action="{{route('login')}}" method="POST" >
    @csrf
      <!--INICIO DE MENSAJE DE RESULTADO DE LOGOUT-->
        @if(session('resultado_logout'))
          <div class="alert alert-warning alert-dismissible fade show">
              Se ha <strong>cerrado</strong> la sesión correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE LOGOUT-->
      <!--INICIO DE MENSAJE DE RESULTADO DE VALIDACION-->
        @if(session('resultado_login'))
          <div class="alert alert-danger alert-dismissible fade show">
              El <strong>usuario</strong> o <strong>contraseña</strong> ingresados son incorrectos.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE VALIDACION-->
    <div class="form-floating">
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
      <label for="usuario">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
      <label for="password">Contraseña</label>
    </div>
    <button class="btn btn-success w-100 py-2" type="submit">Ingresar</button>
    <br>
    <br>
    <center><a href="/" class="mt-5 mb-3 text-body-secondary">Regresar al inicio</a></center>
  </form>
</main>
</div>
<br>
<br>

@endsection('content')
@endif