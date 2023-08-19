@extends('layouts.layout_panel')
<title>Editar cliente - Gestión de Clientes | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (CLIENTES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">EDITAR CLIENTE</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('clientes.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
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
         <form action="{{route('clientes.update', $clientesItem)}}" method="POST" class="row g3">
         	@csrf @method('PATCH') 
        <div class="col-md-6 mb-2">
            <label>Nombre del cliente:</label><center><input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{old('nombre',$clientesItem->nombre)}}" placeholder="{{$clientesItem->nombre}}" required></input></center>
        </div> 
       <div class="col-md-6 mb-2">
            <label>Apellido del cliente:</label><center><input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{old('apellido',$clientesItem->apellido)}}"  placeholder="{{$clientesItem->apellido}}" required></input></center>
        </div> 
        <div class="col-md-6 mb-2">
            <label>Cédula del cliente:</label><center><input type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{old('cedula',$clientesItem->cedula)}}" placeholder="{{$clientesItem->cedula}}" required></input></center>
        </div>
        <div class="col-md-6 mb-2">
            <label>Dirección del cliente:</label><center><input type="text" class="form-control" name="direccion" value="{{$clientesItem->direccion}}" value="{{old('direccion',$clientesItem->direccion)}}" placeholder="{{$clientesItem->direccion}}" required></input></center>
        </div>
        <div class="col-mb-12">
            <label>Teléfono del cliente:</label><center><input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{old('telefono',$clientesItem->telefono)}}" placeholder="{{$clientesItem->telefono}}" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Actualizar</button></center></div>
          <br>
        </form>
    </main>
            <br><br>
    </div>

@endsection('content')