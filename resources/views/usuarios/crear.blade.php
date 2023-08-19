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
            <label>Nombre de Usuario:</label><center><input type="text" class="form-control @error('usuario') is-invalid @enderror" value="{{old('usuario')}}" name="usuario" placeholder="Ej. arturo91" required></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label>Contraseña:</label><center><input type="text" class="form-control" name="password" placeholder="Ej. pw123" value="{{old('password')}}" required></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label>Nombre:</label><center><input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="Ej. Arturo" value="{{old('nombre')}}" required></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label>Apellido:</label><center><input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" placeholder="Ej. Cueva" value="{{old('apellido')}}" required></input></center>
          </div>
          <div class="col-md-6 mb-2">
            <label>Cédula:</label><center><input type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{old('cedula')}}" placeholder="Ej. 0705559639" required></input></center>
            </div>
          <div class="col-md-6 mb-2">
            <label>Rol:</label><center><select class="form-select" name="rol" required>
	            <option value="" disabled selected>Selecciona un rol</option>
	            <option value="administrador">Administrador</option>
	            <option value="personal">Personal</option>	
              <option value="supervisor">Supervisor</option>  
            </select></center>
            </div>
          <div class="col-md-6 mb-2">
            <label>Correo Electrónico:</label><center><input type="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Ej. arturo@portovelo.gob.ec" required></input></center>
            </div>
          <div class="col-md-6 mb-2">
            <label>Teléfono:</label><center><input value="{{old('telefono')}}" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" placeholder="2949888" required></input></center>
          </div>
          <br><br><br><br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Guardar</button></center></div>
        </form>
    </main>
        <br><br>
    </div>

@endsection('content')