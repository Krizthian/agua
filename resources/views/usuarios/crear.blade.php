@extends('layouts.layout_panel')
<title>Crear usuario - Gestión de Usuarios | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">CREAR USUARIO</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('usuarios.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div><br><br>
        <!--FIN DE BOTON DE REGRESAR-->   
         <!--DEVOLVEMOS MENSAJES DE ERROR-->
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
          <!--FIN DE MENSAJES DE ERROR-->    
        <main class="w-100 m-auto">
         <form action="{{route('usuarios.store')}}" method="POST" class="row g3">
         	@csrf
          <div class="col-md-6 mb-2">
            <label>Nombre de Usuario:</label>
          <div class="input-group mb-2">
               <span class="input-group-text"><i class="fa-solid fa-at fa-sm"></i></span> 
                <input type="text" class="form-control @error('usuario') is-invalid @enderror" value="{{old('usuario')}}" name="usuario" placeholder="Ej. arturo91" required></input>
            </div>
          </div>

          <div class="col-md-6 mb-2">
            <label>Contraseña:</label>
          <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa-solid fa-key fa-sm"></i></span> 
              <input type="password" class="form-control" name="password" placeholder="Ej. pw123" value="{{old('password')}}" required></input>
            </div>
          </div>

          <div class="col-md-6 mb-2">
            <label>Nombres:</label>
          <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span> 
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="Ej. Arturo" value="{{old('nombre')}}" required></input>
           </div>
          </div>

          <div class="col-md-6 mb-2">
            <label>Apellidos:</label>
          <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span> 
            <input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" placeholder="Ej. Cueva" value="{{old('apellido')}}" required></input>
            </div>
          </div>

          <div class="col-md-6 mb-2">
            <label>Cédula/RUC:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-id-card fa-sm "></i></span>
              <input type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{old('cedula')}}" placeholder="Ej. 0705559639" required></input>
              </div>
            </div>

          <div class="col-md-6 mb-2">
            <label>Rol:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-shield fa-sm "></i></span>
              <select class="form-select" name="rol" required>
    	            <option value="" disabled selected>Selecciona un rol</option>
    	            <option value="administrador">Administrador</option>
    	            <option value="personal">Personal</option>	
                  <option value="supervisor">Supervisor</option>  
              </select>
              </div>
            </div>

          <div class="col-md-6 mb-2">
            <label>Correo Electrónico:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-envelope fa-sm "></i></span>
                <input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Ej. arturo@portovelo.gob.ec" required></input>
                </div>
            </div>

          <div class="col-md-6 mb-2">
            <label>Teléfono:</label>
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-phone fa-sm "></i></span>
                <input value="{{old('telefono')}}" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" placeholder="2949888" required></input>
            </div>
          </div>

          <br><br><br><br>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-3">
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            <button id="limpiar" type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Limpiar campos</button>
          </div>
              <script>
                document.getElementById("limpiar").addEventListener("click", function() {
                  var campos = document.querySelectorAll("input:not([name='_token']):not([name='_method'])"); // Obtenemos todos los campos de entrada y select
                  campos.forEach(function(campo) {
                    campo.value = ''; // Limpiamos el valor del campo
                  });
                });
            </script>
        </form>
    </main>
        <br><br>
    </div>

@endsection('content')