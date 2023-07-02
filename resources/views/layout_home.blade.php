<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <!--BOOTSTRAP 5.3 - CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!--ARCHIVO DE CSS PERSONALIZADO-->
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
  </head>
  <body class="bg-body-tertiary">
  	<!--INICIO DE CABECERA-->
    <header>
		<nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
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
          <button type="button" class="btn btn-outline-primary me-2">                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
  <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"></path>
</svg></button>
          <button type="button" class="btn btn-success">Iniciar Sesión</button>
        </div>      </div>
  </div>
</nav>
<br>
<br>
<br>
</header>
<!-- FIN DE CABECERA-->
    <center><h1><strong>CONSULTA DE VALORES A PAGAR</h1></strong></center>

<!--INICIO DEL CONTENIDO-->
@yield('content')
<!--<div class="container">
	    <br>
    <br>
      <form>
       <div class="col-auto">
      <center><input type="text" class="form-control" placeholder="Número de medidor o cédula"></input></center>
      <br>
      <center><button type="submit" class="btn btn-primary">Consultar</button></center>
      <br>
</div>

    </form>
</div>-->

<!-- FIN DEL CONTENIDO-->


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
    <p class="mb-1">© 2023 GAD Municipal de Portovelo</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Inicio</a></li>
      <li class="list-inline-item"><a href="#">Municipio</a></li>
      <li class="list-inline-item"><a href="#">Ciudad</a></li>
    </ul>
  </footer>
<!--FIN DE FOOTER-->
<!--JAVASCRIPT DE BOOTSTRAP 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>