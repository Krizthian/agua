@if(!isset($sessionToken))
  <script>
    window.location = "/login";
  </script>
@else
	@extends('layouts.layout_home')
	<title>Actualizar Contraseña | Sistema de Consultas de Valores a Pagar del Agua</title>
	@section('content')
	<center><h1 class="display-4">ACTUALIZAR CONTRASEÑA</h1></center>
	<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
	<main class="form-signin w-100 m-auto">
	  <form action="{{route('login.update')}}" method="POST" >
    @csrf
	<label>Nueva contraseña:</label>
      <input type="hidden" class="form-control" name="id_usuario" value="{{$id_usuarioRecuperar}}">
      <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa la nueva contraseña" required>
      <br>
    </div>
    <button class="btn btn-success w-100 py-2" type="submit">Actualizar</button>
    <br>
    <br>
    <center><a href="/" class="mt-5 mb-3 text-body-secondary text-decoration-none">Regresar al inicio</a></center>
  </form>
</main>
</div>
@endsection('content')
@endif

