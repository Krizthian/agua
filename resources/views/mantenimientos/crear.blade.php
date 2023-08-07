@extends('layouts.layout_panel')
<title>Solicitar Mantenimiento - Gestión de Mantenimientos | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MANTENIMIENTOS)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>

<center><h1 class="display-4">SOLICITAR MANTENIMIENTO</h1></center>
<div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('medidores.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
      <!--FIN DE BOTON DE REGRESAR-->
        <main class="form-signin w-100 m-auto">
         <form action="{{route('mantenimientos.store', $consumoMedidorItem)}}" method="POST">
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
    		<input type="hidden" name="id_medidor" value="{{ $consumoMedidorItem->id }}"> <!-- Supongamos que $medidor es el objeto Medidores -->
            <label>Número de medidor:</label><center><input type="text" class="form-control" name="numero_medidor" value="{{$consumoMedidorItem->numero_medidor}}" readonly required></input></center>
            <label>Fecha para mantenimiento:</label><center><input type="date" class="form-control" name="fecha_mantenimiento" required></input></center>
            <label>Responsable asignado:</label><center><input type="text" class="form-control @error('responsable_asignado') is-invalid @enderror" name="responsable_asignado" placeholder="Ej. David Lopez" required></input></center>
            <label>Estado de mantenimiento:</label><center>
            <select class="form-select input-group mb-2" id="estado_mantenimiento" name="estado_mantenimiento" required>
                    <option value="solicitado" required>Ingresado</option>
            </select>

          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Guardar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')