@extends('layouts.layout_panel')
<title>Crear cliente - Gestión de Clientes | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (CLIENTES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">CREAR CLIENTE</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('clientes.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
      <!--FIN DE BOTON DE REGRESAR-->
      <br>
      <br>
        <main class="w-100 m-auto">
         <form action="{{route('clientes.store')}}" class="row g3" method="POST">
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
          <div class="col-md-6 mb-2">
            <label>Nombres del cliente:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}" name="nombre" placeholder="Ej. Arturo" required></input>
            </div>  
          </div>  
          <div class="col-md-6 mb-2">
            <label>Apellidos del cliente:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span>
            <input type="text" class="form-control @error('apellido') is-invalid @enderror" value="{{old('apellido')}}" name="apellido" placeholder="Ej. Cueva" required></input>
            </div>  
          </div>  
          <div class="col-md-6 mb-2">
            <label>Cédula/RUC del cliente:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-id-card fa-sm"></i></span>
            <input type="text" class="form-control @error('cedula') is-invalid @enderror" value="{{old('cedula')}}" name="cedula" placeholder="Ej. 0705558887" required></input>
            </div> 
          </div> 
          <div class="col-md-6 mb-2">
            <label>Dirección del cliente:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-location-dot fa-sm"></i></span>            
            <input type="text" class="form-control" name="direccion" value="{{old('direccion')}}" placeholder="Ej. Avenida del Ejercito" required></input>
            </div> 
           </div> 
        <div class="col-mb-12">
            <label>Teléfono del cliente:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-phone fa-sm"></i></span> 
            <input type="text" class="form-control @error('telefono') is-invalid @enderror" value="{{old('telefono')}}" name="telefono" placeholder="Ej. 2949888" required></input>
            </div> 
          </div> 
         <div class="col-mb-12">
            <label>Correo Electrónico:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-envelope fa-sm"></i></span>             
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Ej. mbermeo@gmail.com" required></input>
          </div>
        </div>
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
          <br>
        </form>
    </main>
        <br><br>
    </div>

@endsection('content')