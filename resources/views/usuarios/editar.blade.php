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

<center><h1 class="display-4">EDITAR USUARIO</h1></center>
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
         <form action="{{route('usuarios.update', $usuariosItem)}}" method="POST" class="row g3">
         	@csrf @method('PATCH')

          <div class="col-md-12 mb-2">
            <label>Nombre de Usuario:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-at fa-sm"></i></span> 
              <input type="text" class="form-control @error('usuario') is-invalid @enderror" name="usuario" value="{{old('usuario',$usuariosItem->usuario)}}" placeholder="{{$usuariosItem->usuario}}" required></input>
            </div>
          </div>


          <div class="col-md-6 mb-2">
            <label>Nombres:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span> 
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre',$usuariosItem->nombre)}}" placeholder="{{$usuariosItem->nombre}}" required></input>
            </div>  
          </div>  


          <div class="col-md-6 mb-2">
            <label>Apellidos:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span> 
              <input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{old('apellido',$usuariosItem->apellido)}}" placeholder="{{$usuariosItem->apellido}}" required></input>
           </div>  
          </div>  


          <div class="col-md-6 mb-2">
            <label>Cédula/RUC:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-id-card fa-sm"></i></span> 
              <input type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{old('cedula',$usuariosItem->cedula)}}" placeholder="{{$usuariosItem->cedula}}" required></input>
            </div>  
          </div>  


          <div class="col-md-6 mb-2">
            <label>Rol:</label>
               <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-shield fa-sm"></i></span>
              <select class="form-select" name="rol" required>
                <option value="{{old('rol',$usuariosItem->rol)}}" selected>{{ucfirst($usuariosItem->rol);}}</option>
                <option value="administrador">Administrador</option>
                <option value="personal">Personal</option>  
                <option value="supervisor">Supervisor</option>  
            </select>
            </div>  
          </div>  


        <div class="col-md-6 mb-2">
            <label>Correo Electrónico:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-at fa-sm"></i></span> 
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',$usuariosItem->email)}}" placeholder="{{$usuariosItem->email}}" required></input>
            </div>  
          </div>  


        <div class="col-md-6 mb-2">
            <label>Teléfono:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-phone fa-sm"></i></span> 
              <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{old('telefono',$usuariosItem->telefono)}}" placeholder="{{$usuariosItem->telefono}}" required></input>
          </div>  
         </div>  

          <br><br><br><br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button></center></div>
          <br>
        </form>
    </main>
        <br><br>
    </div>

@endsection('content')