@extends('layouts.layout_panel')
<title>Ingresar Consumo - Gestión de Medidores | Sistema de Consultas de Valores a Pagar del Agua</title>
<link rel="stylesheet" href="{{url('css/custom_login.css')}}">
@section('content')
    <style>
    /*ESTILO PERSONALIZADO PARA PANEL DE GESTION (MEDIDORES)*/
	    .bg-body-tertiary {
	        --bs-bg-opacity: 1;
	         background-color: rgba(var(--bs-tertiary-bg-rgb),var(--bs-bg-opacity))!important;
	     }
    </style>
    <center><h1 class="display-4">INGRESAR CONSUMO</h1></center>
    <div class="container">
      <br>
	      <div title="Regresar" class="col-md-12 bg-light text-right"><a href="{{route('medidores.index')}}" type="submit" class="btn btn-primary float-start"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
		  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
		</svg></a></div>
        <main class="form-signin w-100 m-auto">
         <form action="{{route('consumos.almacenarConsumo', $consumoMedidorItem)}}" method="POST">
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
            <label>Numero de medidor:</label><center><input type="text" class="form-control mb-2" name="numero_medidor" value="{{$consumoMedidorItem->numero_medidor}}" placeholder="{{$consumoMedidorItem->numero_medidor}}" disabled></input></center>

            <label>Ubicación de medidor:</label><center><input type="text" class="form-control mb-2" name="ubicacion" value="{{$consumoMedidorItem->ubicacion}}" placeholder="{{$consumoMedidorItem->ubicacion}}" disabled></input></center>

            <label>Consumo anterior (m<sup><strong>3</strong></sup>):</label><center><input type="text" class="form-control mb-2" name="consumo_anterior" 
            @isset($consumoMedidorItem->consumo->consumo_actual) value="{{$consumoMedidorItem->consumo->consumo_actual}}" placeholder="{{$consumoMedidorItem->consumo_actual}}" @else value="0" placeholder="0" @endisset readonly></input></center>

            <label>Fecha de lectura anterior:</label><center><input type="text" class="form-control mb-2" name="fecha_lectura_anterior" @isset($consumoMedidorItem->consumo->fecha_lectura_actual) value="{{$consumoMedidorItem->consumo->fecha_lectura_actual}}" placeholder="{{$consumoMedidorItem->fecha_lectura_actual}}" @else value="2000-08-05" placeholder="2000-08-05" @endisset readonly></input></center>

            <label>Consumo actual (m<sup><strong>3</strong></sup>):</label><center><input type="text" class="form-control mb-2 @error('consumo_actual') is-invalid @enderror" name="consumo_actual" placeholder="Ingrese el consumo actual" required></input></center>

            <label>Responsable de lectura:</label><center><input type="text" class="form-control mb-2 @error('responsable') is-invalid @enderror" name="responsable" placeholder="Ingrese al responsable de la lectura" required></input></center>
          <br>
            <div class="col-md-12 text-right"><center><button type="submit" class="btn btn-success">Guardar Consumo</button></center></div>
          <br>
        </form>
    </main>
        </div>
        <br><br>
    </div>

@endsection('content')
