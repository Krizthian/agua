@extends('layouts.layout_panel')
<title>Editar usuario - Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1><strong>EDITAR USUARIO</h1></strong></center>
    <div class="container">
      <br>
        <main class="form-signin w-100 m-auto">
         <form action="{{route('usuarios.update', $usuariosItem)}}" method="POST">
         	@csrf @method('PATCH')
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
            <label>Nombre de Usuario:</label><center><input type="text" class="form-control" name="usuario" value="{{$usuariosItem->usuario}}" placeholder="{{$usuariosItem->usuario}}" required></input></center>
            <label>Contraseña:</label><center><input type="text" class="form-control" name="password" value="{{$usuariosItem->password}}" placeholder="{{$usuariosItem->password}}" required></input></center>
            <label>Nombre:</label><center><input type="text" class="form-control" name="nombre" value="{{$usuariosItem->nombre}}" placeholder="{{$usuariosItem->nombre}}" required></input></center>
            <label>Apellido:</label><center><input type="text" class="form-control" name="apellido" value="{{$usuariosItem->apellido}}" placeholder="{{$usuariosItem->apellido}}" required></input></center>
            <label>Cédula:</label><center><input type="text" class="form-control" name="cedula" value="{{$usuariosItem->cedula}}" placeholder="{{$usuariosItem->cedula}}" required></input></center>
            <label>Rol:</label><center><select class="form-select" name="rol" required>
              <option value="{{$usuariosItem->rol}}" selected>{{ucfirst($usuariosItem->rol);}}</option>
              <option value="administrador">Administrador</option>
              <option value="personal">Personal</option>  
            </select></center>
            <label>Correo Electronico:</label><center><input type="email" class="form-control" name="email" value="{{$usuariosItem->email}}" placeholder="{{$usuariosItem->email}}" required></input></center>
            <label>Telefono:</label><center><input type="text" class="form-control" name="telefono" value="{{$usuariosItem->telefono}}" placeholder="{{$usuariosItem->telefono}}" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Actualizar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')