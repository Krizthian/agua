<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <!--BOOTSTRAP 5.3 - CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel='shortcut icon' href='{{asset('img/favicon.ico')}}' type='image/x-icon'>
    <!--ARCHIVO DE CSS PERSONALIZADO-->
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
  </head>
  <body class="bg-body-tertiary">
  	<!--INICIO DE CABECERA-->
    <header>
		<nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
    <img src="{{url('img/logo.png')}}" width="170" height="50" alt="GAD DE PORTOVELO logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Desplegar navegación">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">

        </li>
      </ul>
<div class="text-end">
          <a href="/" type="button" title="Inicio" class="btn btn-primary me-2"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
          <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"></path>
        </svg></a>
        <!--MOSTRAR BOTON DE PANEL DE GESTIÓN-->
          @if(isset(session()->get('sesion')['usuario']))
            <a href="/panel" type="button" class="btn btn-success" title="Panel de Gestión">
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
              </svg>
              </a>
          @else
            <a type="button" href="/login" class="btn btn-success">Iniciar Sesión</a>
          @endif
          <!--FIN MOSTRAR BOTON DE PANEL DE GESTIÓN-->
          <!--MOSTRAR BOTON DE LOGOUT-->
          @if(isset(session()->get('sesion')['usuario']))
          <a href="{{route('salir')}}" onclick="event.preventDefault(); document.getElementById('formulario-salir').submit();" type="button" title="Cerrar sesión" class="btn btn-danger me-3"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </svg></a>
          <form id="formulario-salir" action="{{route('salir')}}" method="POST" style="display: none;">
              @csrf
          </form> 
          @endif
          <!--FIN MOSTRAR BOTON DE LOGOUT-->
        </div></div>
  </div>
</nav>
<br>
<br>
<br>
</header>
<!-- FIN DE CABECERA-->

<!--INICIO DEL CONTENIDO-->
@yield('content')

<!--INICIO DE FOOTER-->
<br>
<br>
<br><br>
<br>
<br><br>
<br>
<br><br>
<br>
<br><br>
<br>
<br><br>
<footer class="my-5 pt-5 text-body-secondary text-center text-small">
    <p class="mb-1">Gobierno Autónomo Descentralizado Municipal de Portovelo | Copyright © {{date('Y')}} </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a class="text-decoration-none" href="/">Inicio</a></li>
      <li class="list-inline-item"><a class="text-decoration-none" href="http://portovelo.gob.ec">Municipio</a></li>
      <li class="list-inline-item"><a class="text-decoration-none" href="http://www.portovelo.gob.ec/canton-portovelo/">Ciudad</a></li>
    </ul>
  </footer>
<!--FIN DE FOOTER-->
<!--JAVASCRIPT DE BOOTSTRAP 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>