@if(isset(session()->get('sesion')['usuario']))
  <script>
    window.location = "/panel";
  </script>
@else
@extends('layouts.layout_home')
<title>Recuperar Contraseña | Sistema de Consultas de Valores a Pagar del Agua</title>
@section('content')
<center><h1 class="display-4">RECUPERAR CONTRASEÑA</h1></center>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<main class="form-signin w-100 m-auto">
  <form action="{{route('login.RecuperarProcesar')}}" method="POST" >
    @csrf
    <label for="email">Correo Electrónico</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>
    <br>
    <button class="btn btn-success w-100 py-2" type="submit">Enviar</button>
    <br>
    <br>
    <center><a href="/" class="mt-5 mb-3 text-body-secondary text-decoration-none">Regresar al inicio</a></center>
  </form>
</main>
</div>
@endsection('content')
@endif