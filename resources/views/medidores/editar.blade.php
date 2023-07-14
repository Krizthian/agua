@extends('layouts.layout_panel')
<title>Editar medidor - Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1><strong>EDITAR MEDIDOR</h1></strong></center>
    <div class="container">
      <br>

        <main class="form-signin w-100 m-auto">
         <form action="{{route('medidores.update', $medidoresItem)}}" method="POST">
         	@csrf @method('PATCH')
           <div class="col-auto">
            <label>Numero de medidor:</label><center><input type="text" class="form-control" name="numero_medidor" value="{{$medidoresItem->numero_medidor}}" placeholder="{{$medidoresItem->numero_medidor}}" disabled></input></center>
            <label>Nombre del cliente:</label><center><input type="text" class="form-control" name="nombre" value="{{$medidoresItem->nombre}}" placeholder="{{$medidoresItem->nombre}}" required></input></center>
            <label>Apellido del cliente:</label><center><input type="text" class="form-control" name="apellido" value="{{$medidoresItem->apellido}}" placeholder="{{$medidoresItem->apellido}}" required></input></center>
            <label>Cédula del cliente:</label><center><input type="text" class="form-control" name="cedula" value="{{$medidoresItem->cedula}}" placeholder="{{$medidoresItem->cedula}}" required></input></center>
            <label>Dirección del cliente:</label><center><input type="text" class="form-control" name="direccion" value="{{$medidoresItem->direccion}}" placeholder="{{$medidoresItem->direccion}}" required></input></center>
            <label>Télefono del cliente:</label><center><input type="text" class="form-control" name="telefono" value="{{$medidoresItem->telefono}}" placeholder="{{$medidoresItem->telefono}}" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Actualizar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')