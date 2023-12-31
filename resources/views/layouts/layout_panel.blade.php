@if(!isset(session()->get('sesion')['usuario']))
  <script>
    window.location = "/login";
  </script>
@else

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.bootstrap4.min.css">
      
      <!--BOOTSTRAP 5.3-->
        <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.css">
        <link rel='shortcut icon' href='{{asset('img/favicon.ico')}}' type='image/x-icon'>

      <!--DATATABLE-->   
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" defer></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js" defer></script>    
      <!--FIN DATATABLE-->
    <!--INICIO DE SWEETALERTS-->
           <link rel="stylesheet" href="{{url('css/sweetalert2.min.css')}}">
    <!--FIN DE SWEETALERTS-->
    <link rel="stylesheet" href="{{url('css/custom.css')}}">
    <link rel="stylesheet" href="{{url('css/footer.css')}}">
    <link rel="stylesheet" href="{{url('css/blanco.css')}}">
  </head>
  <body class="bg-body-tertiary">
    <header>
		<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary borde_coloreado " data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/panel">
    <img class="img-fluid" src="{{url('img/logo.webp')}}" width="170" height="50" alt="GAD DE PORTOVELO logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Desplegar navegación">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-pills nav-justified">
        <li class="nav-item">
        <li class="nav-item">
          <a class="nav-link {{setActive('panel.index')}}" aria-current="page" href="/panel">Inicio</a>
        </li>
       <li class="nav-item">
                @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')<a class="nav-link {{setActive('planillas.index')}}" aria-current="page" href="/planillas">Planillas</a>@endif
        </li>
       <li class="nav-item">
           @if(session()->get('sesion')['rol'] == 'personal' || session()->get('sesion')['rol'] == 'administrador')<a class="nav-link {{setActive('clientes.index')}}" aria-current="page" href="/clientes">Clientes</a>@endif
       </li>
       <li class="nav-item">
                <a class="nav-link {{setActive('medidores.index')}}" aria-current="page" href="/medidores">Medidores</a>
        </li>
            <!--ESTE VINCULO SOLO SERA VISTO Y SERA ACCESIBLE PARA USUARIOS CON ROL DE ADMINISTRADOR-->
              <li class="nav-item">
                @if(session()->get('sesion')['rol'] == 'administrador')<a class="nav-link {{setActive('usuarios.index')}}" aria-current="page" href="/usuarios">Usuarios</a>@endif
              </li>
             <!--FIN VINCULO RESERVADO-->
             <li class="nav-item">
                <a class="nav-link {{setActive('reclamos.index')}}" aria-current="page" href="/reclamos">Reclamos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{setActive('reportes')}}" aria-current="page" href="/reportes">Reportes</a>
              </li>
        </li>
      </ul>
      <!--TEXTO DE SALUDO-->
      <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
        <li>
              <a href="{{route('usuarios.actualizarPassword')}}" class="nav-link text-white">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle mx-1" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>  Bienvenido, {{session()->get('sesion')['nombres']}}
              </a>
            </li>
      </ul>
      <!--FIN DE TEXTO DE SALUDO-->
   <div class="text-end">
      <!--BOTON DE INICIO-->
          <a href="/" type="button" title="Inicio" class="btn btn-primary me-2"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
          <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"></path>
        </svg></a>
      <!--BOTON DE INICIO FIN-->
        <!--BOTON SALIR INICIO-->
          <a href="{{route('salir')}}" onclick="event.preventDefault(); document.getElementById('formulario-salir').submit();" type="button" title="Cerrar sesión" class="btn btn-danger me-2"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
          <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
        </svg></a>
          <form id="formulario-salir" action="{{route('salir')}}" method="POST" style="display: none;">
              @csrf
          </form> 
        <!--BOTON SALIR FIN-->
           </div>
  </div>
</nav>
<br><br><br><br><br><br>
</header>
        <!--COMPROBAMOS LA RUTA EN LA QUE NOS ENCONTRAMOS-->
        @if(Route::is('usuarios.actualizarPassword') )
          @else <!--SI ESTAMOS EN CUALQUIER OTRA RUTA DEL PANEL DE GESTION MOSTRAMOS EL MENSAJE-->
        <!--COMPROBACION DE ACTUALIZACION DE CONTRASEÑA-->
            @if(session()->get('sesion')['updated_at'] == '1970-01-01 00:00:00')
              <div class="container-sm">
                      <div class="alert alert-warning alert-dismissible fade show">
                          <center><strong><i class="fa-solid fa-circle-exclamation"></i> Aviso:</strong> Aún no has actualizado tu contraseña, <a class="nav-link" href="{{route('usuarios.actualizarPassword')}}"><i>haz clic aquí para actualizarla</i></a></center>
                      </div>
              </div>
            @endif <!--FIN DE COMPROBACION DE ACTUALIZACION DE CONTRASEÑA-->
          @endif <!--FIN DE COMPROBACION DE LA RUTA EN LA QUE NOS ENCONTRAMOS-->
      
<!--CONTENIDO-->
  @yield('content')
    </body>
<!--FIN CONTENIDO-->
<!--INICIO FOOTER-->
<footer class="my-5 pt-5 text-body-secondary text-center text-small text-muted" >

    <!--INICIO DE ICONOS DE REDES SOCIALES-->
          <ul class="list-inline mt-5">
            <li class="list-inline-item mx-2 mt-5">
                  <!-- Facebook -->
                <a title="Facebook" href="https://www.facebook.com/PortoveloGADM"><i class=" list-inline-item mx-2 fab fa-facebook-f fa-1x" style="color: #3b5998;"></i></a>

                <!-- X -->
                <a title="X" href="https://x.com/GadPortovelo"><i class=" list-inline-item mx-2 fab fa-brands fa-x-twitter fa-1x" style="color: #000;"></i></a>

                <!-- Instagram -->
                <a title="Instagram" href="https://www.instagram.com/gadportovelo/"><i class="list-inline-item mx-2 fab fa-instagram fa-1x" style="color: #ac2bac;"></i></a>

                <!-- YouTube -->
                <a title="YouTube" href="https://www.youtube.com/channel/UCLomKkKiMVOrg8CCgkYr1kA?view_as=subscriber"><i class="list-inline-item mx-2 fab fa-youtube fa-1x" style="color: #ed302f;"></i></a>

                <!-- TikTok -->
                <a title="TikTok" href="https://www.tiktok.com/@gadportovelo"><i class="list-inline-item mx-2 fab fa-tiktok fa-1x" style="color: #000;"></i></a>
            </li>
        </ul>
    <center><hr class="hr_short"></center>
  <!--FIN DE ICONOS DE REDES SOCIALES-->
    <p class="mb-0">Gobierno Autónomo Descentralizado Municipal de Portovelo | Copyright © {{date('Y')}} </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a class="text-decoration-none" href="/">Inicio</a></li>
      <li class="list-inline-item"><a class="text-decoration-none" href="http://portovelo.gob.ec">Municipio</a></li>
      <li class="list-inline-item"><a class="text-decoration-none" href="http://www.portovelo.gob.ec/canton-portovelo/">Ciudad</a></li>
    </ul>
  </footer>
</div>
<!--FIN FOOTER-->
  <!--JAVASCRIPT BOOTSTRAP 5.3-->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script> 
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
</html>

@endif