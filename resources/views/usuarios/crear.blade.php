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

<center><h1><strong>CREAR USUARIO</h1></strong></center>
    <div class="container">
      <br>
        <main class="form-signin w-100 m-auto">
         <form action="{{route('usuarios.store')}}" method="POST">
         	@csrf
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
           <div class="col-auto">
            <label>Nombre de Usuario:</label><center><input type="text" class="form-control" name="usuario" placeholder="Ej. arturo91" required></input></center>

            <label>Contraseña:</label><center><input type="text" class="form-control" name="password" placeholder="Ej. pw123" required></input></center>

            <label>Nombre:</label><center><input type="text" class="form-control" name="nombre" placeholder="Ej. Arturo" required></input></center>

            <label>Apellido:</label><center><input type="text" class="form-control" name="apellido" placeholder="Ej. Cueva" required></input></center>

            <label>Cédula:</label><center><input type="text" class="form-control" name="cedula" placeholder="Ej. 0705559639" required></input></center>

            <label>Rol:</label><center><select class="form-select" name="rol" required>
	            <option value="" disabled selected>Selecciona un rol</option>
	            <option value="administrador">Administrador</option>
	            <option value="personal">Personal</option>	
            </select></center>

            <label>Correo Electronico:</label><center><input type="email" class="form-control" name="email" placeholder="Ej. arturo@portovelo.gob.ec" required></input></center>
            <label>Telefono:</label><center><input type="text" class="form-control" name="telefono" placeholder="2949888" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Guardar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')