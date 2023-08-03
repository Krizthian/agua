@extends('layouts.layout_panel')
<title>Editar medidor - Gestión de Clientes | Sistema de Consultas de Valores a Pagar del Agua</title>
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
        <main class="form-signin w-100 m-auto">
         <form action="{{route('clientes.update', $clientesItem)}}" method="POST">
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
            <label>Numero de medidor:</label><center><input type="text" class="form-control" name="numero_medidor" value="{{$clientesItem->numero_medidor}}" placeholder="{{$clientesItem->numero_medidor}}" disabled></input></center>
            <label>Nombre del cliente:</label><center><input type="text" class="form-control" name="nombre" value="{{$clientesItem->nombre}}" placeholder="{{$clientesItem->nombre}}" required></input></center>
            <label>Apellido del cliente:</label><center><input type="text" class="form-control" name="apellido" value="{{$clientesItem->apellido}}" placeholder="{{$clientesItem->apellido}}" required></input></center>
            <label>Cédula del cliente:</label><center><input type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{old('cedula',$clientesItem->cedula)}}" placeholder="{{$clientesItem->cedula}}" required></input></center>
            <label>Dirección del cliente:</label><center><input type="text" class="form-control" name="direccion" value="{{$clientesItem->direccion}}" placeholder="{{$clientesItem->direccion}}" required></input></center>
            <label>Télefono del cliente:</label><center><input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{old('telefono',$clientesItem->telefono)}}" placeholder="{{$clientesItem->telefono}}" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Actualizar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')