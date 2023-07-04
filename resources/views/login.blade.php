@extends('layouts.layout_home')

@section('content')
<center><h1 ><strong>INICIAR SESIÓN</strong></h1></center>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<main class="form-signin w-100 m-auto">
  <form>
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