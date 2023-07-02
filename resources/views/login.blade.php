@extends('layout_home')

@section('content')
<center><h1 ><strong>INICIAR SESIÓN</strong></h1></center>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
<main class="form-signin w-100 m-auto">
  <form>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Contraseña</label>
    </div>
    <button class="btn btn-success w-100 py-2" type="submit">Ingresar</button>
    <br>
    <br>
    <center><a class="mt-5 mb-3 text-body-secondary">Regresar al inicio</a></center>
  </form>
</main>
</div>
<br>
<br>

@endsection('content')