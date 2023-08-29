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

<center><h1 class="display-4">EDITAR MEDIDOR</h1></center>
    <div class="container">
      <br>
        <!--BOTON DE REGRESAR-->
          <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('medidores.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
          </svg></a></div>
      <!--FIN DE BOTON DE REGRESAR-->
        <main class="form-signin w-100 m-auto">
         <form action="{{route('medidores.update', $consumoMedidorItem)}}" method="POST">
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
            <label>Número de medidor:</label>
            <div class="input-group mb-2">
              <span class="input-group-text"><i class="fa-solid fa-gauge fa-sm"></i></span>             
            <input type="text" class="form-control" name="numero_medidor" value="{{$consumoMedidorItem->numero_medidor}}" disabled></input>
            </div>
          </div>

         <div class="col-auto"> 
	       <label>Propietario del medidor:</label>
          <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa-solid fa-user fa-sm"></i></span> 
	            <select class="form-select input-group  @error('id_cliente') is-invalid @enderror" id="id_cliente" name="id_cliente" required>
	                <option value="{{$consumoMedidorItem->cliente->id}}" required selected>{{$consumoMedidorItem->cliente->apellido}}, {{$consumoMedidorItem->cliente->nombre}} - {{$consumoMedidorItem->cliente->cedula}} </option>
	                @foreach ($queryClientes as $cliente)
	                    <option value="{{ $cliente->id }}" required>
	                        {{ $cliente->apellido }}, {{ $cliente->nombre }} - {{$cliente->cedula}}
	                    </option>
	                @endforeach
	            </select>
            </div>
          </div>

          <div class="col-auto">
            <label>Fecha de instalación:</label>
          <div class="input-group mb-2">
            <span class="input-group-text"><i class="fa-solid fa-calendar-days fa-sm"></i></span> 
            <input type="text" class="form-control" name="fecha_instalacion" value="{{$consumoMedidorItem->fecha_instalacion}}" disabled></input>
            </div>
          </div>
          <div class="col-auto">
            <label>Ubicación:</label>
              <div class="input-group mb-2">
                <span class="input-group-text"><i class="fa-solid fa-location-dot fa-sm"></i></span> 
            <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" name="ubicacion" value="{{$consumoMedidorItem->ubicacion}}" placeholder="{{$consumoMedidorItem->ubicacion}}" required></input>
          </div>
        </div>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')