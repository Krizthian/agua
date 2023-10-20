@if(isset(session()->get('sesion')['usuario']))
  <script>
    window.location = "/panel";
  </script>
@else
@extends('layouts.layout_home')
<title>Inicio de Sesión | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
<center><h1 class="display-4">INICIAR SESIÓN</h1></center>
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
      <!--INICIO DE MENSAJE DE RESULTADO DE ACTUALIZACION DE CONTRASEÑA-->
        @if(session('resultado_update'))
          <div class="alert alert-success alert-dismissible fade show">
              La <strong>contraseña</strong> se ha actualizado correctamente, por favor inicia sesión con tu nueva contraseña.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE ACTUALIZACION DE CONTRASEÑA-->
      <!--INICIO DE MENSAJE DE RESULTADO DE VALIDACION-->
        @if(session('resultado_login'))
          <div class="alert alert-danger alert-dismissible fade show">
              El <strong>usuario</strong> o <strong>contraseña</strong> ingresados son incorrectos.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE VALIDACION-->
      <!--INICIO DE MENSAJE DE RESULTADO DE RECUPERACION-->
        @if(session('resultado_recuperacion'))
          <div class="alert alert-success alert-dismissible fade show">
              Si el <strong>correo</strong> ingresado <strong>coincide</strong> con nuestros registros, recibirás un enlace para recuperar tu contraseña.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE RESULTADO DE RECUPERACION-->
      <!--INICIO DE MENSAJE DE CUENTA INACTIVA-->
        @if(session('resultado_inactivo'))
          <div class="alert alert-warning alert-dismissible fade show">
              Actualmente el <strong>usuario</strong> ingresado se encuentra <strong>inactivo</strong> por lo que no es posible iniciar sesión.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE CUENTA INACTIVA-->
      <!--INICIO DE MENSAJE DE ENLACE EXPIRADO-->
        @if(session('enlace_expirado'))
          <div class="alert alert-danger alert-dismissible fade show">
              Este <strong>enlace</strong> ya no está disponible para recuperar la contraseña.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE DE ENLACE EXPIRADO-->

      <!--INICIO DE MENSAJE DE CONTRASEÑA ACTUALIZADA-->
        @if(session('resultado_cambio'))
          <div class="alert alert-success alert-dismissible fade show">
              Se ha actualizado la <strong>contraseña</strong> correctamente.
          </div>
        @endif  
      <!--FIN DE MENSAJE DE CONTRASEÑA ACTUALIZADA-->

    <div class="form-floating">
      <input type="text" class="form-control" id="usuario" name="usuario" value="{{old('usuario')}}" placeholder="Usuario" required>
      <label for="usuario">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
      <label for="password">Contraseña</label>
    </div>
    <button class="btn btn-success w-100 py-2" type="submit">Ingresar</button>
    <br>
    <br>
    <center><a href="/" title="Regresar al inicio" class="mt-5 mb-3 text-body-secondary text-decoration-none">Regresar al inicio</a></center>
    <center><a href="{{route('recuperar')}}" title="¿Olvidaste tu contraseña?" class="mt-5 mb-3 text-body-secondary text-decoration-none">¿Olvidaste tu contraseña?</a></center>
  </form>
</main>
</div>
@endsection('content')
@endif