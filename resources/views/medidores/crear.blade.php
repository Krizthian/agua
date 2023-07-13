@extends('layouts.layout_panel')
<title>Crear medidor - Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1><strong>CREAR MEDIDOR</h1></strong></center>
    <div class="container">
      <br>

        <main class="form-signin w-100 m-auto">
         <form action="{{route('medidores.store')}}" method="POST">
         	@csrf
           <div class="col-auto">
            <label>Numero de medidor:</label><center><input type="text" class="form-control" name="numero_medidor" placeholder="Ej. 010051" required></input></center>
            <label>Nombre del cliente:</label><center><input type="text" class="form-control" name="nombre" placeholder="Ej. Arturo" required></input></center>
            <label>Apellido del cliente</label><center><input type="text" class="form-control" name="apellido" placeholder="Ej. Cueva" required></input></center>
            <label>Cédula del cliente</label><center><input type="text" class="form-control" name="cedula" placeholder="Ej. 0705558887" required></input></center>
            <label>Dirección del cliente</label><center><input type="text" class="form-control" name="direccion" placeholder="Ej. Avenida del Ejercito" required></input></center>
            <label>Télefono del cliente</label><center><input type="text" class="form-control" name="telefono" placeholder="Ej. 2949888" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Guardar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')